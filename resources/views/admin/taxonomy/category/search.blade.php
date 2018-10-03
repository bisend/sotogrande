@extends('layouts.admin')

@section('title')
    <title>{{get_string('search_results') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('search_results')}}</h3>
@endsection
<div class="col s8 right right-align mbot10">
    <a href="{{route('admin.taxonomy.category.index')}}" class="btn waves-effect"> {{get_string('category_all')}}</a>
    <a href="{{route('admin.taxonomy.category.create')}}" class="btn waves-effect"> {{get_string('create_category')}} <i class="material-icons small">add_circle</i></a>
    <a href="#" class="mass-delete btn waves-effect btn-red"><i class="material-icons color-white">delete</i></a>
</div>
<div class="col s12">
    @if($categories->count())
    <div class="table-responsive">
    <table class="table bordered striped">
        <thead class="thead-inverse">
        <tr>
            <th>
                <input type="checkbox" class="filled-in primary-color" id="select-all" />
                <label for="select-all"></label>
            </th>
            <th>{{get_string('name')}}</th>
            <th>{{get_string('order')}}</th>
            <th class="icon-options">{{get_string('options')}}</th>
        </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>
                        <input type="checkbox" class="filled-in primary-color" id="{{$category->id}}" />
                        <label for="{{$category->id}}"></label>
                    </td>
                    <td>{{$category}}</td>
                    <td>{{$category->order}}</td>
                    <td>
                        <div class="icon-options">
                            <a href="{{url('category').'/'.$category->alias}}" title="{{get_string('view_category')}}"><i class="small material-icons color-primary">visibility</i></a>
                            <a href="{{route('admin.taxonomy.category.edit', $category->id)}}" title="{{get_string('edit_category')}}"><i class="small material-icons color-primary">mode_edit</i></a>
                            <a href="#" class="delete-button" data-id="{{$category->id}}" title="{{get_string('delete_category')}}"><i class="small material-icons color-red">delete</i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    {{$categories->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection

@section('footer')
    <script>
        $('.delete-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var token = $('.token').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('delete_confirm')}}',
                onEscape: true,
                backdrop: true,
                buttons: {
                    cancel: {
                        label: '{{get_string('no')}}',
                        className: 'btn waves-effect'
                    },
                    confirm: {
                        label: '{{get_string('yes')}}',
                        className: 'btn waves-effect'
                    }
                },
                callback: function (result) {
                    if(result){
                        $.ajax({
                            url: '{{ url('/admin/taxonomy/category/') }}/'+id,
                            type: 'post',
                            data: {_method: 'delete', _token :token},
                            success:function(msg) {
                                selector.remove();
                                toastr.success(msg);
                            },
                            error:function(msg){
                                toastr.error(msg.responseJSON);
                            }
                        });
                    }
                }
            });
        });

        $('.mass-delete').click(function(event){
            event.preventDefault();
            var id = [];
            var selector = [];
            $("tbody input:checkbox:checked").each(function(){
                id.push($(this).attr('id'));
                selector.push($(this).parents('tr'));
            });
            var token = $('.token').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('delete_confirm_bulk')}}',
                onEscape: true,
                backdrop: true,
                buttons: {
                    cancel: {
                        label: '{{get_string('no')}}',
                        className: 'btn waves-effect'
                    },
                    confirm: {
                        label: '{{get_string('yes')}}',
                        className: 'btn waves-effect'
                    }
                },
                callback: function (result) {
                    if(result) {
                        $.ajax({
                            url: '{{ url('/admin/taxonomy/category/massdestroy') }}',
                            type: 'post',
                            data: {id: id, _token :token},
                            success:function(msg) {
                                $.each(selector, function(index, item){
                                    $(this).remove();
                                });
                                $('#select-all').prop('checked', false);
                                toastr.success(msg);
                            },
                            error:function(msg){
                                toastr.error(msg.responseJSON);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection