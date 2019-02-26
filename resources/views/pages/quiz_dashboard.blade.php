@extends('template.layout')

@section('content')
    <h2>Quiz Listing</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Questions</th>
            <th>Estimated Time</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($quizes as $quiz)
            <tr>
                <td>{{ $quiz->name }}</td>
                <td>
                    @php
                        $quiz_questions_count =  $quiz_questions->get('count(*)', 'quiz_id', '=', $quiz->id );
                    @endphp
                    {{ modelCount($quiz_questions_count[0]) }}
                </td>
                <td>{{ $quiz->etm }}</td>
                <td>
                    <a href="/quiz/{{ $quiz->id }}/sign-up" class="btn btn-danger">Start Quiz</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop