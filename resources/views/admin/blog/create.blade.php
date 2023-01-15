@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create New Blog</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                            'group' => 'form',
                            'url' => '/blog',
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="row margin-left-40">
                                <div class="col-md-offset-1 col-md-12">

                                    <div class="row  margin-bottom-10">
                                        <label class="control-label col-md-2" for="title">Title :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-4">
                                            {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Enter title']) !!}
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        </div>
                                    </div>
                                    <div class="row  margin-bottom-10">
                                        <label class="control-label col-md-2" for="slug">Slug :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-4">
                                            {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control', 'placeholder' => 'Enter slug']) !!}
                                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                                        </div>
                                    </div>
                                    <div class="row  margin-bottom-10">
                                        <label class="control-label col-md-2" for="description">Description :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-4">
                                            {!! Form::text('description', null, ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Enter description']) !!}
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- <div class="form-actions"> --}}
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button class="btn btn-circle green" type="submit">
                                            <i class="fa fa-check"></i>SUBMIT
                                        </button>
                                        <a href="{{ URL::to('/blog') }}" class="btn btn-circle btn-outline grey-salsa">
                                            CANCEL</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

@stop
