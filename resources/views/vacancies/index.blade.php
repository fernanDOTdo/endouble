@extends('layouts.app')

@section('title', 'Vacancies')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Vacancies <strong>from  {{ $source }}</strong>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($vacancies as $vacancy)
                                <tr>
                                    <th scope="row">{{ $vacancy->id }}</th>
                                    <td>{{ $vacancy->title }}</td>
                                    <td>{{ $vacancy->content }}</td>
                                    <td>{{ $vacancy->description }}</td>
                                    <td><a href="{{ route('vacancies.edit', $vacancy->id) }}"> Edit </a>
                                        <form class="delete" action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="submit" value="Delete" class="btn btn-danger btn-xs">
                                        </form>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" colspan="6">No Vacancies</th>
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
@section('footer_scripts')
    <script>
        $(".delete").on("submit", function(){
            return confirm("Are you sure you want to delete this Vacancy?");
        });
    </script>
@endsection