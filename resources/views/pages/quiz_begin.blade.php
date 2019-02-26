@extends('template.layout')

@section('content')
    <div class="col-12" id="container">
        <div class="row">
            <div class="col-6">
                
                <form action="/quiz/{{ request()->segments()['2'] }}/sign-up" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Begin Quiz</button>
                </form>
            
            </div>
        </div>
    </div>
@stop

@push('footer_js')
    <script>
        var app = new Vue({
            el: '#app',
            delimiters: ["[", "]"],
            data() {
                return {
                    info: null
                }
            },
            mounted() {
                axios
                    .get('https://api.coindesk.com/v1/bpi/currentprice.json')
                    .then(response => (this.info = response.data.bpi))
            },
            filters: {
                currencydecimal (value) {
                    return value.toFixed(2)
                }
            },
        });
    </script>
@endpush