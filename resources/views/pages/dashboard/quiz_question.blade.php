@extends('template.layout')

@section('content')
    
    <a href="/admin/quiz/{{ request()->segments()[3] }}/question/create" class="btn btn-warning">
        Create Question
    </a>
    
    <h2>Quiz Question Listing</h2>
    
    @include('errors.errors')
    @include('errors.success')
    
    
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Questions</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quiz_questions as $quiz_question)
            <tr>
                <td>{{ $quiz_question->question }}</td>
                <td>
                    <a href="/admin/quiz/{{ request()->segments()[3] }}/question/{{ $quiz_question->id}}/answer"
                       class="btn btn-info">Create Answer</a>
                    <a href="/admin/quiz/{{ request()->segments()[3] }}/question/{{ $quiz_question->id }}/edit"
                       class="btn btn-warning">Edit</a>
                    <a href="/admin/quiz/{{ request()->segments()[3] }}/question/{{ $quiz_question->id }}/destroy"
                       class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop