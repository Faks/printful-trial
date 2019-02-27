@extends('template.layout')

@section('content')
    <h2>Thanks for participating, {{ $user_quiz->name }}!</h2>
    
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Review</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                You answered {{ $total_correct_answers }} correctly out of {{ $total_questions }} questions.
            </td>
        </tr>
        </tbody>
    </table>
@stop