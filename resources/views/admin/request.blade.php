@extends('layouts.admin')

@section('title')
    <title>{{get_string('requests') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('requests')}}</h3>
@endsection
<div class="col s12">
<div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="tab active"><a href="#register-interests" data-toggle="tab">Register Interest</a></li>
            <li class="tab"><a href="#callbacks" data-toggle="tab">Call Back</a></li>
        </ul>
    </div>
    <div class="tab-content">
    
        <div id="register-interests" class="table-responsive tab-pane active">
        @if($register_interests->count())
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Property Reference</th>
                    <th class="icon-options">Status</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($register_interests as $register_interest)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$register_interest->id}}" />
                            <label for="{{$register_interest->id}}"></label>
                        </td>
                        <td>{{$register_interest->name}}</td>
                        <td>{{$register_interest->phone}}</td>
                        <td>{{$register_interest->email}}</td>
                        <td><a href="{{ $register_interest->reference }}" target="_blank">{{$register_interest->reference_name}}</a></td>
                        <td class="icon-options">
                            <form action="">
                                <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
                                <input type="checkbox" class="filled-in primary-color status-callback" id="status{{$register_interest->id}}"  data-id="{{$register_interest->id}}" {{ $register_interest->status ? 'checked' : '' }}/>
                                <label for="status{{$register_interest->id}}"></label>
                            </form>
                        </td>
                        <td>
                            <div class="icon-options">
                                <a href="#" class="delete-button" data-id="{{$register_interest->id}}" title="{{get_string('delete_property')}}"><i class="small material-icons color-red">delete</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$register_interests->links()}}
            @else
            <strong class="center-align">{{get_string('no_results')}}</strong>
            @endif
        </div>
        
        <div id="callbacks" class="table-responsive tab-pane">
        @if($callbacks->count())
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Property Reference</th>
                    <th class="icon-options">Status</th>
                    <!-- <th>Reference</th> -->
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($callbacks as $callback)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$callback->id}}" />
                            <label for="{{$callback->id}}"></label>
                        </td>
                        <td>{{$callback->name}}</td>
                        <td>{{$callback->phone}}</td>
                        <td><a href="{{ $callback->reference }}" target="_blank">{{$callback->reference_name}}</a></td>
                        <td class="icon-options">
                            <form action="">
                                <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
                                <input type="checkbox" class="filled-in primary-color status-callback" id="status{{$callback->id}}"  data-id="{{$callback->id}}" {{ $callback->status ? 'checked' : '' }}/>
                                <label for="status{{$callback->id}}"></label>
                            </form>
                        </td>
                        <!-- <td><a href="{{ $callback->reference }}">{{$callback->reference_name}}</a></td> -->
                        <td>
                            <div class="icon-options">
                                <a href="#" class="delete-button" data-id="{{$callback->id}}" title="{{get_string('delete_property')}}"><i class="small material-icons color-red">delete</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$callbacks->links()}}
            @else
                <strong class="center-align">{{get_string('no_results')}}</strong>
            @endif
        </div>
    </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function(){
            $('.activate-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var thisBtn = $(this).parents('.icon-options');
                var status = selector.children('.page-status');
                var token = $('[name="_token"]').val();
                var type = $(this).data('type');
                switch(type){
                    case 1 : var url = '{{ url('/admin/user/activate/') }}/'; break;
                    case 2 : var url = '{{ url('.admin/owner/activate/') }}/'; break;
                    case 3 : var url = '{{ url('/admin/property/activate/') }}/'; break;
                    case 4 : var url = '{{ url('/admin/service/activate/') }}/'; break;
                }
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('activate_item')}}',
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
                                url: url + id,
                                type: 'post',
                                data: {_token :token},
                                success:function(msg) {
                                    thisBtn.children('.activate-button').addClass('hidden');
                                    thisBtn.children('.deactivate-button').removeClass('hidden');
                                    status.html('{{get_string('active')}}');
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

            $('.status-callback').on('change', function(){
                var id = $(this).data('id');
                var value = $(this).is(':checked') ? 1 : 0;
                var token = $('[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/admin/request/changestatus/') }}/'+id,
                    type: 'post',
                    data: {_token :token, value: value},
                    success:function(msg) {
                        toastr.success(msg);
                    },
                    error:function(msg){
                        toastr.error(msg.responseJSON);
                    }
                });
            });

            $('.delete-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var token = $('[name="_token"]').val();
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
                                url: '{{ url('/admin/request/delete/') }}/'+id,
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
            
        });
    </script>
@endsection