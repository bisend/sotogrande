@extends('layouts.admin')

@section('title')
    <title>{{get_string('create_post') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('create_post')}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
    {!!Form::open(['method' => 'post', 'url' => route('admin.blog.store'), 'files' => 'true'])!!}
    <div class="panel">
    <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="tab active"><a href="#content-panel" data-toggle="tab">{{get_string('content')}}</a></li>
            <li class="tab"><a href="#data-panel" data-toggle="tab">{{get_string('data')}}</a></li>
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
                                <div class="col l6 m6 s12">
                                    <div class="form-group  {{$errors->has('title.'.$language->id.'') ? 'has-error' : ''}}">
                                        {{Form::text('title['.$language->id.']', null, ['class' => 'form-control', 'placeholder' => get_string('post_title')])}}
                                        {{Form::label('title['.$language->id.']', get_string('post_title_label'))}}
                                        @if($errors->has('title.'.$language->id.''))
                                            <span class="wrong-error">* {{$errors->first('title.'.$language->id.'')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col s12">
                                    {{Form::textarea('body['.$language->id.']', null, ['class' => 'hidden desc-content'])}}
                                    @if($errors->has('body.'.$language->id.''))
                                        <span class="wrong-error">{{$errors->first('body.'.$language->id.'')}}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="data-panel" class="tab-pane">
            <div class="col l6 m6 s12">
                <div class="input-group {{$errors->has('image') ? 'has-error' : ''}}">
                    <label class="input-group-btn">
                <span class="btn btn-primary waves-effect">{{get_string('upload_featured_picture')}} <i class="material-icons small">add_circle</i>
                    {!! Form::file('image', ['id' => 'image', 'class' => 'hidden']) !!}
                </span>
                    </label>
                    <input type="text" class="form-control" readonly>
                </div>
                @if($errors->has('image'))
                    <span class="wrong-error">* {{$errors->first('image')}}</span>
                @endif
                <span class="field-info">{{get_string('min_dimension_360')}}</span>
            </div>
        </div>
        </div>
        <div class="col clearfix l4 m4 s12 mtop10">
            <div class="form-group">
                <button class="btn waves-effect" type="submit" name="action">{{get_string('create_post')}}</button>
                <a href="{{route('admin.blog.index')}}" class="btn waves-effect">{{get_string('blog_all')}}</a>
            </div>
        </div>
        {{Form::hidden('user_id', Auth::user()->id)}}
        {!!Form::close()!!}
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
             placeholder: '{{get_string('enter_content')}}',
             disableDragAndDrop: true,
             toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link", "picture", "video"]],
                ["view", ["codeview"]]
             ],callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });
    </script>
@endsection