@extends('layouts.app')

@section('title', 'Sources')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sources
                    <span class="pull-right">
                        <a href="{{ route('sources.refresh') }}" class="btn btn-warning btn-xs">
                                    <i class="fa fa-btn fa-refresh"></i> Reload From Disk
                        </a>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Descriptiom</th>
                                    <th>Priority</th>
                                    <th>Enabled</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($sources as $source)
                                <tr>
                                    <th scope="row">{{ $source->id }}</th>
                                    <td>{{ $source->name }}</td>
                                    <td>{{ $source->description }}</td>
                                    <td>{{ $source->priority }}</td>
                                    <td>{{ ($source->enabled) ? 'Yes' : 'No' }}</td>
                                    <td><a href="{{ route('sources.edit', $source->id) }}"> Edit </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" colspan="6">No Sources</th>
                                </tr>
                            @endforelse
                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection