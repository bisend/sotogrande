@extends('layouts.admin')

@section('title')
    <title>{{'Edit country' . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{'Edit country'}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
        {!! Form::open(['method' => 'patch', 'url' => route('admin.taxonomy.country.update', $country->id), 'files' => 'true']) !!}
    <div class="panel">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a href="#content-panel" data-toggle="tab">{{get_string('content')}}</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div id="content-panel" class="tab-pane active">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                @foreach($languages as $language)
                                    <li class="tab {{$language->default ? 'active' : ''}}"><a href="#lang{{$language->id}}" data-parent="#content" data-toggle="tab"><img src="{{$language->flag}}"/><span>{{$language->language}}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                @foreach($languages as $language)
                                    <div id="lang{{$language->id}}" class="tab-pane {{$language->default ? 'active' : ''}}">
                                        <div class="col s12">
                                            <div class="form-group  {{$errors->has('name.'.$language->id.'') ? 'has-error' : ''}}">
                                                {{Form::text('name['.$language->id.']', $country->content($language->id)->location, ['class' => 'form-control', 'placeholder' => get_string('enter_country_name')])}}
                                                {{Form::label('name['.$language->id.']', get_string('country_name'))}}
                                                @if($errors->has('name.'.$language->id.''))
                                                    <span class="wrong-error">* {{$errors->first('name.'.$language->id.'')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            {{Form::textarea('description['.$language->id.']', $country->content($language->id)->description, ['class' => 'hidden desc-content'])}}
                                            @if($errors->has('description.'.$language->id.''))
                                                <span class="wrong-error">{{$errors->first('description.'.$language->id.'')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col clearfix s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action">{{'Edit country'}}</button>
                    <a href="{{route('admin.taxonomy.country.index')}}" class="btn waves-effect">{{'d'}}</a>
                    <a href="#!" class="delete-button btn waves-effect btn-red" data-id="{{$country->id}}"><i class="material-icons color-white">delete</i></a> 
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function(){
            $('.desc-content').summernote({
                height: 200,
                maxwidth: false,
                minwidth: false,
                placeholder: '{{get_string('enter_country_content')}}',
                disableDragAndDrop: true,
                toolbar: [
                    ["style", ["style"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]]
                ],callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });

            $('.delete-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
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
                                url: '{{ url('/admin/taxonomy/country/') }}'+id,
                                type: 'post',
                                data: {_method: 'delete', _token :token},
                                success:function(msg) {
                                    window.country = "/admin/service/country";
                                }
                            });
                        }
                    }
                });
            });

            $('.delete-featured-image').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var token = $('[name="_token"]').val();
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('delete_featured_image')}}',
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
                                url: '{{ url('/admin/taxonomy/country/deleteImage') }}/'+id,
                                type: 'post',
                                data: {_token :token},
                                success:function(msg) {
                                    $('#featured-image').remove();
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

            $('.delete-home-image').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var token = $('[name="_token"]').val();
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('delete_featured_image')}}',
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
                                url: '{{ url('/admin/taxonomy/country/deleteHomeImage') }}/'+id,
                                type: 'post',
                                data: {_token :token},
                                success:function(msg) {
                                    $('#home-image').remove();
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