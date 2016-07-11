@extends('layouts.app')

@section('title', 'Edit '.$vacancy->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $vacancy->title }} <strong>from  {{ $source }}</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('vacancies.update', $vacancy->id) }}">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input type="text" name="title" id="title" class="form-control" value="{{ $vacancy->title }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>
                            <div class="col-md-6">
                                <textarea name="content" id="content" class="form-control" rows="5">{{ trim($vacancy->content) }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <input type="text" name="description" id="description" class="form-control" value="{{ $vacancy->description }}">
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ route('vacancies.index') }}" class="btn btn-warning">
                                    <i class="fa fa-btn fa-hand-o-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-floppy-o"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
