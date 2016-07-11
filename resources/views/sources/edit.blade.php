@extends('layouts.app')

@section('title', 'Edit '.$source->name.' Data Source')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $source->name }} Data Source</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('sources.update', $source->id) }}">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <p class="form-control-static">{{ $source->name }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <p class="form-control-static">{{ $source->description }}</p>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <label for="priority" class="col-md-4 control-label">Priority</label>
                            <div class="col-md-6">
                                <input id="priority" type="text" class="form-control" name="priority" value="{{ $source->priority }}">

                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        @if ($source->name != 'Default')
                                            <input type="checkbox" name="enabled" {{ $source->enabled ? 'checked="checked"' : '' }} value="1"> Enabled
                                        @else
                                            <mark>The Default Data Source can't be disabled</mark>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ route('sources.index') }}" class="btn btn-warning">
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
