<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Cache;
use App\Helpers\CommonQuery;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //slider
        // if(Cache::has('boot_sliders')) {
        //     $sliders = Cache::get('boot_sliders');
        // } else {
        //     $sliders = DB::table('sliders')
        //         ->select('id', 'name', 'url', 'image')
        //         ->where('status', ACTIVE)
        //         ->where('type', SLIDER2)
        //         ->limit(PAGINATE_SLIDER)
        //         ->orderByRaw(DB::raw("position = '0', position"))
        //         ->orderBy('id', 'desc')
        //         ->get();
        //     Cache::forever('boot_sliders', $sliders);
        // }
        // view()->share('sliders', $sliders);
        //post data
        //productpopular
        if(Cache::has('boot_productpopular')) {
            $productpopular = Cache::get('boot_productpopular');
        } else {
            $productpopular = self::getArchives(PRODUCT, 'view', 'desc', PAGINATE_AREA);
            Cache::forever('boot_productpopular', $productpopular);
        }
        view()->share('productpopular', $productpopular);
        //populararchives
        if(Cache::has('boot_populararchives')) {
            $populararchives = Cache::get('boot_populararchives');
        } else {
            $populararchives = self::getArchives(POST, 'view', 'desc');
            Cache::forever('boot_populararchives', $populararchives);
        }
        view()->share('populararchives', $populararchives);
        //get config data
        if(Cache::has('boot_config')) {
            $config = Cache::get('boot_config');
        } else {
            $config = DB::table('configs')->first();
            Cache::forever('boot_config', $config);
        }
        view()->share('configcode', $config->code);
        view()->share('configfbappid', $config->facebook_app_id);
        view()->share('configfbpage', $config->facebook_page);
        view()->share('confighotline', $config->hotline);
        view()->share('configaddress', $config->address);
        //all menu
        //current url
        $currentUrl = url()->current();
        //topmenu
        if(Cache::has('menutype1'.$currentUrl)) {
            $menutype1 = Cache::get('menutype1'.$currentUrl);
        } else {
            $menutype1 = self::getMenu();
            Cache::forever('menutype1'.$currentUrl, $menutype1);
        }
        view()->share('topmenu', $menutype1);
        //sidemenu
        if(Cache::has('menutype2')) {
            $menutype2 = Cache::get('menutype2');
        } else {
            $menutype2 = self::getMenu(MENUTYPE2);
            Cache::forever('menutype2', $menutype2);
        }
        view()->share('sidemenu', $menutype2);
        //bottommenu
        if(Cache::has('menutype3')) {
            $menutype3 = Cache::get('menutype3');
        } else {
            $menutype3 = self::getMenu(MENUTYPE3);
            Cache::forever('menutype3', $menutype3);
        }
        view()->share('bottommenu', $menutype3);
        //mobilemenu
        if(Cache::has('menutype4'.$currentUrl)) {
            $menutype4 = Cache::get('menutype4'.$currentUrl);
        } else {
            $menutype4 = self::getMenu(MENUTYPE4);
            Cache::forever('menutype4'.$currentUrl, $menutype4);
        }
        view()->share('mobilemenu', $menutype4);
    }

    private function getArchives($type = POST, $orderColumn = 'start_date', $orderSort = 'desc', $limit = PAGINATE_SIDE)
    {
        $data = DB::table('posts')
            ->select('id', 'name', 'slug', 'summary', 'image')
            ->where('status', ACTIVE)
            ->where('type', $type)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->limit($limit)
            ->orderBy($orderColumn, $orderSort)
            ->get();
        return $data;
    }

    private function getMenus($type, $name)
    {
        $cacheName = 'menu_'.$type.'_'.$name;
        if(Cache::has($cacheName)) {
            $menu = Cache::get($cacheName);
        } else {
            $menu = DB::table('menus')
                ->where('type', $type)
                ->where('status', ACTIVE)
                ->orderByRaw(DB::raw("position = '0', position"))
                ->orderBy('name')
                ->get();
            Cache::forever($cacheName, $menu);
        }
        view()->share($name, $menu);
    }

    private function getMenu($type=MENUTYPE1)
    {
        $data = DB::table('menus')
            ->select('id', 'name', 'url', 'parent_id', 'level', 'position', 'icon', 'image')
            ->where('type', $type)
            ->where('status', ACTIVE)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('name')
            ->get();
        if($type==MENUTYPE1 || $type==MENUTYPE2 || $type==MENUTYPE3) {
            $output = '<ul class="menu">';
        } else {
            $output = '<ul>';
        }
        $output .= self::_visit($data, $type);
        $output .= '</ul>';
        return $output;
    }
    private function _visit($data, $type=MENUTYPE1, $parentId=0)
    {
        $output = '';
        $sub = self::_sub($data, $parentId);
        if(count($sub) > 0) {
            foreach($sub as $value) {
                $hasChild = self::_hasChild($value->id);
                $classHasChild = ($hasChild)?' hasChild':'';
                $output .= '<li class="'.CommonQuery::checkCurrent(url($value->url)).$classHasChild.'"><a href="'.url($value->url).'">'.$value->icon.$value->name.'</a>';
                if($hasChild) {
                    if($type==MENUTYPE1) {
                        if($value->parent_id == 0) {
                            $output .= '<span class="dropBottom"></span>';
                        } else {
                            $output .= '<span class="dropRight"></span>';
                        }
                        $output .= '<ul class="submenu">';
                    } else {
                        $output .= '<ul>';
                    }
                    $output .= self::_visit($data, $type, $value->id);
                    $output .= '</ul></li>';
                } else {
                    $output .= '</li>';
                }
            }
        }
        return $output;
    }
    private function _sub($data, $parentId)
    {
        $sub = array();
        if(isset($data)) {
            foreach($data as $key => $value) {
                if ($value->parent_id == $parentId) {$sub[$key] = $value;}
            }
        }
        return $sub;
    }
    private function _hasChild($id)
    {
        $data = DB::table('menus')
            ->where('parent_id', $id)
            ->where('status', ACTIVE)
            ->first();
        if($data) {
            return true;
        } else {
            return null;
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
