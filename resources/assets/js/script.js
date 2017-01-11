$(document).foundation();
// var swiper = new Swiper('.swiper-container', {
// pagination: '.swiper-pagination',
// paginationClickable: true,
// slidesPerView: 5,
// spaceBetween: 15,
// autoplay: 4500,
// nextButton: '.swiper-button-next',
// prevButton: '.swiper-button-prev',
// breakpoints: {
//     1024: {
//         slidesPerView: 4,
//         spaceBetween: 15
//     },
//     768: {
//         slidesPerView: 3,
//         spaceBetween: 10
//     },
//     640: {
//         slidesPerView: 2,
//         spaceBetween: 5
//     },
//     320: {
//         slidesPerView: 1,
//         spaceBetween: 5
//     }
// }
// });
function mopen()
{
    $('.mobile-box').addClass('revy');
}
function mclose()
{
    $('.mobile-box').removeClass('revy');
}
gototop();
function gototop()
{
    // $(".gotop").hide();
    $(window).scroll(function() {
        if ($(this).scrollTop() > 10) {
            $('.gotop').addClass('gototop');
            // $('.gotop').fadeIn();
        } else {
            $('.gotop').removeClass('gototop');
            // $('.gotop').fadeOut();
        }
    });
    $('.gotop').click(function() {
        $('body,html').animate({scrollTop: 4}, 300);
        return false;
    });
}
// sky();
// function sky()
// {
//     var sidemenuOffset = $('#sidemenu').offset().top;
//     var sidemenu = $('#sidemenu').height() + 10;
//     $(window).scroll(function() {
//         var yuki = $('.yuki').offset().top - $('#sidemenu').offset().top;
//         if ($(this).scrollTop() > sidemenuOffset) {
//             $('#sidemenu').addClass('sky');
//         } else if(yuki == sidemenu || $(this).scrollTop() <= sidemenuOffset) {
//             $('#sidemenu').removeClass('sky');
//         }
//     });
// }
function makelove(id)
{
    var csrf_token = $('input[name="_token"]').val();
    $.ajax({
        type: 'post',
        url : '/love',
        data:{
            'id' : id,
            '_token': csrf_token
        },
        beforeSend: function(){
            //
        },
        success: function(data)
        {
            $('.msglove'+id).addClass('msgloved');
            setTimeout(function(){ $('.msglove'+id).removeClass('msgloved'); }, 1000);
            if(data != 2) {
                $('.loved').hide().html(data).fadeIn(600);
            }
            return;
            // if(data==2) {
            //     alert('Hệ thống đang bận');
            //     return;
            // } else if(data==3) {
            //     alert('Sản phẩm này đã được thêm trước đó');
            //     return;
            // } else {
            //     alert('Đã thêm vào danh sách yêu thích');
            //     return;
            // }
        }
    });
}
function unlove(rowId)
{
    var csrf_token = $('input[name="_token"]').val();
    $.ajax({
        type: 'post',
        url : '/unlove',
        data:{
            'rowId' : rowId,
            '_token': csrf_token
        },
        beforeSend: function(){
            //
        },
        success: function(data)
        {
            if(data != 2) {
                $('.loved').hide().html(data).fadeIn(600);
            }
            return;
        }
    });
}
// function ordernow()
// {
//     var id = $('input[name="id"]').val();
//     var name = $('input[name="name"]').val();
//     var email = $('input[name="email"]').val();
//     var tel = $('input[name="tel"]').val();
//     var csrf_token = $('input[name="_token"]').val();
//     if(id == '' || name == '' || email == '' || tel == '') {
//         alert('Mời bạn nhập đầy đủ thông tin');
//         return;
//     }
//     $.ajax({
//         type: 'post',
//         url : '/order',
//         data:{
//             'id' : id,
//             'name' : name,
//             'email' : email,
//             'tel' : tel,
//             '_token': csrf_token
//         },
//         beforeSend: function(){
//             //
//         },
//         success: function(data)
//         {
//             resetInput();
//             if(data==1) {
//                 alert('Bạn đã đặt hàng thành công. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất có thể');
//             } else if(data==3) {
//                 alert('Hệ thống đang bận. Mời bạn quay lại sau ít phút');
//             } else {
//                 alert('Hệ thống đang bận');
//             }
//             return;
//         }
//     });
//     function resetInput()
//     {
//         $('input[name="name"]').val('');
//         $('input[name="email"]').val('');
//         $('input[name="tel"]').val('');
//     }
// }