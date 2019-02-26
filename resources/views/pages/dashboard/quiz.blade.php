@extends('template.layout')

@section('content')
    <h2>Quiz Listing</h2>
    
    @include('errors.errors')
    @include('errors.success')
    
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Questions</th>
            <th>Estimated Time</th>
            <th>Answer Type</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quizes as $quiz)
            <tr>
                <td>{{ $quiz->name }}</td>
                <td>questions counter</td>
                <td>{{ $quiz->etm }}</td>
                <td>{{ ucwords($quiz->type) }}</td>
                <td>
                    <a href="/admin/quiz/{{ $quiz->id }}/question" class="btn btn-info">Create Question</a>
                    <a href="/admin/quiz/{{ $quiz->id }}/edit" class="btn btn-warning">Edit</a>
                    <a href="/admin/quiz/{{ $quiz->id }}/destroy" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop