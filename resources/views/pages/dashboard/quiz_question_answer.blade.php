@extends('template.layout')

@section('content')
    
    <a href="/admin/quiz/{{ request()->segments()[3] }}/question/{{ request()->segments()[5] }}/answer/create"
       class="btn btn-warning">
        Create Question Answer
    </a>
    
    <h2>Quiz Question Listing</h2>
    
    @include('errors.errors')
    @include('errors.success')
    
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Answer</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quiz_question_answers as $quiz_question_answer)
            <tr>
                <td>{{ $quiz_question_answer->answer }}</td>
                <td>
                    <a href="/admin/quiz/{{ request()->segments()[3] }}/question/{{ request()->segments()[5] }}/answer/{{$quiz_question_answer->id }}/edit"
                       class="btn btn-warning">Edit</a>
                    <a href="/admin/quiz/{{ request()->segments()[3] }}/question/{{ request()->segments()[5] }}/answer/{{$quiz_question_answer->id }}/destroy"
                       class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop