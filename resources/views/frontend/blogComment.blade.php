@extends('layouts.frontend.include.master')
@section('title')
    @yield('Welcome to BlogSite')
@endsection

@section('content')
    @include('layouts.frontend.include.slider')
    <div class="contact-list margin-top-10 margin-bottom-10">

        <div class="container">
            <div class="col-md-4">
                @include('layouts.include.flash')
            </div>
            @if (!empty($target))
                <h1 class="header margin-bottom-10">{{ $target->title ?? '' }}</h1>
                <div class="row">
                    <div class="contact-box center-version">
                        <a>
                            <address class="m-t-md description">
                                {!! $target->description ?? '' !!}
                            </address>
                            <div class="">
                                {!! Form::open([
                                    'group' => 'form',
                                    'url' => '/blog-comment',
                                    'class' => 'form-horizontal',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}

                                {!! Form::hidden('id', $target->id, [
                                    'id' => 'id'
                                ]) !!}
                                {!! Form::hidden('slug', $target->slug, [
                                    'id' => 'slug'
                                ]) !!}


                                {{ csrf_field() }}
                                <div class="form-body comment-box">
                                    <div class="row">
                                        <label class="control-label col-md-2 comment-label" for="comment">Comment :</label>
                                        <div class="col-md-4">
                                            {!! Form::textarea('comment', null, [
                                                'id' => 'comment',
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter comment',
                                            ]) !!}
                                            <span class="text-danger">{{ $errors->first('comment') }}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 cmnt-submit">
                                                <button class="btn btn-circle btn-success" type="submit">
                                                    <i class="fa fa-check"></i>SUBMIT
                                                </button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="row comment-box">
                                    <div class="col-md-6">
                                        @if (!empty($comment))
                                        <h4>Your Comments: </h4>
                                            @foreach ($comment as $info)
                                            <li>{{ $info->comment ?? '' }} [ Date: {{ $info->created_at ?? '' }} ]</li>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
