@extends('template.layout')

@section('content')
    <div class="col-12" id="container">
        <div class="row">
            <div class="col-6">
                @include('partial.quiz_question_form', [
                'action' => '/admin/quiz/'. request()->segments()[3] .'/question/'. request()->segments()[5] .
                '/update' ,
                'button_text' => 'Edit',
                'model' => $quiz_questions
                ])
            </div>
        </div>
    </div>
@stop
