@extends('admin.layouts.master')

@section('title', 'Menu')

@section('content')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Thêm menu</a>
		<a onclick="callupdate();" class="btn btn-success" id="loadMsg">Update Position</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Menu</h3><i> - Total: {{ $data->total() }}</i>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tr>
						<th><input type="checkbox" id="checkall" onClick="toggle(this)"></th>
						<th>Name</th>
						<th>URL</th>
						<th>Mục cha</th>
						<th>Type</th>
						<th>Status</th>
						<th>Position</th>
						<th style="width:240px;">Action</th>
					</tr>
					@foreach($data as $key => $value)
					<tr>
						<td><input type="checkbox" class="id" name="id[]" value="{{ $value->id }}"></td>
						<td>{{ $value->name }}</td>
						<td>{{ $value->url }}</td>
						<td>{{ CommonQuery::getFieldById('menus', $value->parent_id, 'name') }}</td>
						<td>{{ CommonOption::getMenuType($value->type) }}</td>
						<td><a id="status_{{ $value->id }}" onclick="updateStatus({{ $value->id }}, 'status')" style="cursor: pointer;" title="Click to change">{!! CommonOption::getStatus($value->status) !!}</a></td>
						<td><input type="text" name="position" value="{{ $value->position }}" size="5" class="onlyNumber" style="text-align: center;"></td>
						<td>
							<a href="{{ route('admin.menu.edit', $value->id) }}" class="btn btn-primary">Sửa</a>
							<form method="POST" action="{{ route('admin.menu.destroy', $value->id) }}" style="display: inline-block;">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
							</form>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		{{ $data->links() }}
	</div>
</div>

@include('admin.menu.script')

@stop