@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Update Blog</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($target, [
                            'route' => ['blog.update', $target->id],
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'files' => true,
                        ]) !!}
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="row margin-left-40">
                                <div class="col-md-offset-1 col-md-12">
                                    <div class="row">
                                        <label class="control-label col-md-2" for="title">Title :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-4">
                                            {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control']) !!}
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="control-label col-md-2" for="slug">Slug :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-4">
                                            {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control']) !!}
                                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="control-label col-md-2" for="description">Description :<span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-4">
                                            {!! Form::text('description', null, ['id' => 'description', 'class' => 'form-control']) !!}
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <button class="btn btn-circle green" type="submit">
                                        <i class="fa fa-check"></i>UPDATE
                                    </button>
                                    <a href="{{ URL::to('/blog') }}" class="btn btn-circle btn-outline grey-salsa">
                                        CANCEL</a>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>


@stop
