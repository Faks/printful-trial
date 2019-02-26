@extends('template.layout')

@section('content')
    <div class="col-12" id="container">
        <div class="row">
            
            <div class="col-12">
                <div class="card">
                    <form action="/quiz/{{ request()->segments()[2] }}/take/{{ request()->segments()[4] }}/store"
                          method="post">
                        
                        <div class="card-header">{{ $quiz_question_answer[0]->question }}</div>
                        
                        <div class="card-body">
                            <div class="form-group form-check">
                                <div class="col-12">
                                    <div class="row">
                                        
                                        @foreach($quiz_question_answer as $answer)
                                            
                                            <div class="col-4">
                                                <label class="form-check-label">
                                                    <input @if ($quiz->type == "single")
                                                           name="answer"
                                                           @else
                                                           name="answer[]"
                                                           @endif
                                                    
                                                           value="{{ $answer->id }}"
                                                           class="form-check-input"
                                                    
                                                           @if ($quiz->type == "single")
                                                           type="radio"
                                                           @else
                                                           type="checkbox"
                                                        @endif
                                                    >{{
                                                    $answer->answer }}
                                                </label>
                                            </div>
                                        
                                        @endforeach
                                        
                                        {{--<div class="col-3">--}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{----}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{----}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{--</div>--}}
                                        {{----}}
                                        {{--<div class="col-3">--}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{----}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{----}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{--</div>--}}
                                        {{----}}
                                        {{--<div class="col-3">--}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{----}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{----}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{--</div>--}}
                                        {{----}}
                                        {{--<div class="col-3">--}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{----}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{----}}
                                        {{--<label class="form-check-label">--}}
                                        {{--<input name="answer" class="form-check-input" type="radio">Remember me--}}
                                        {{--</label>--}}
                                        {{--</div>--}}
                                    
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                        
                        <input
                            
                            
                            @if (modelCount($quiz_question[0]) == request()->segments()[4])
                            type="hidden"
                            name="next_review" value="yes"
                            @else
                            type="hidden"
                            name="next_url" value="/quiz/{{ request()->segments()[2] }}/take/{{request()->segments()
                            [4] += 1 }}"
                            @endif
                        
                        >
                        
                        <input type="hidden" name="quiz_question_id"
                               value="{{ $quiz_question_answer[0]->quiz_question_id }}">
                    </form>
                
                </div>
            </div>
        
        </div>
    </div>
@stop

@push('footer_js')
    <script>
        var app = new Vue({
            el: '#app',
            delimiters: ["{", "}"],
            data() {
                return {
                    info: null
                }
            },
            mounted() {
                axios
                    .get('https://api.coindesk.com/v1/bpi/currentprice.json')
                    .then(response => (this.info = response))
            }
        });
    </script>
@endpush