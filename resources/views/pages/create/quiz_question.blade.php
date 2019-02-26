@extends('template.layout')

@section('content')
    <div class="col-12" id="container">
        <div class="row">
            <div class="col-6">
                @include('partial.quiz_question_form', [
                'action' => '/admin/quiz/'. request()->segments()[3] .'/question/create' ,
                'button_text' => 'Create' ,
                'model' => null
                ])
            </div>
        </div>
    </div>
@stop
