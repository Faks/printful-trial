@extends('template.layout')

@section('content')
    <div class="col-12" id="container">
        <div class="row">
            <div class="col-6">
                <div class="card text-white card-transparency" id="card-animate-f">
                    <div class="card-body">
                        <div class="row row-helper">
                            <h5 class="card-title">
                                <span class="signup">
                                    Don’t have an account?
                                </span>
                                
                                <span class="login hidden">
                                   Have an account?
                                </span>
                            </h5>
                            <hr>
                            <p class="card-text card-sigh-up-text" id="card-text">
                                <span class="signup">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </span>
                                
                                <span class="login hidden">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </span>
                            </p>
                            <div class="card-footer">
                                <div class="row">
                                    <a class="btn btn-size btn-sigh-up btn-round-corners btn-vertically-centred signup card-left">
                                        Sign Up
                                    </a>
                                    
                                    <a class="btn btn-size btn-sigh-up btn-round-corners btn-vertically-centred login hidden card-right">
                                        Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card card-animate card-megabit ml-n-30" id="card-animate">
                    <div class="card-body">
                        <div class="row">
                            @include('errors.errors')
                            @include('errors.success')
    
                            <form class="form-right" action="/store" method="post" id="form">
                                
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h4>
                                                    <span class="signup">Login
                                                        <hr>
                                                    </span>
                                                    
                                                    <span class="login hidden">Sign Up
                                                        <hr>
                                                    </span>
                                                </h4>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <img src="/img/logo.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group input-group row ml-0 hidden" id="name">
                                    <label for="input-name"
                                           class="col-sm-12 col-form-label col-form-label-sm pl-0 pb-0">Name<sup
                                            class="p-1 text-danger">*</sup></label>
                                    <input type="text" name="name" class="form-control form-control-sm"
                                           id="input-name" disabled required aria-required="true">
                                    
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <img src="/img/ic_user_default.png">
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group input-group row ml-0">
                                    <label for="input-email"
                                           class="col-sm-12 col-form-label col-form-label-sm pl-0 pb-0">Email<sup
                                            class="p-1 text-danger">*</sup></label>
                                    <input type="email" name="email" class="form-control form-control-sm"
                                           id="input-email" required aria-required="true">
                                    
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <img src="/img/ic_mail_default.png">
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group input-group row ml-0">
                                    <label for="input-password"
                                           class="col-sm-12 col-form-label col-form-label-sm pl-0 pb-0">Password<sup
                                            class="p-1 text-danger">*</sup></label>
                                    <input type="password" name="password" class="form-control form-control-sm"
                                           id="input-password" required aria-required="true">
                                    
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <img src="/img/ic_lock_default.png">
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group row mg-t-30">
                                    <div class="col-sm-12 pr-0 pl-0">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="btn-group">
                                                    <button type="submit"
                                                            class="btn btn-size btn-login btn-round-corners">
                                                        <span class="signup">Login</span>
                                                        <span class="login hidden">Sign up</span>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4 pt-14">
                                                <a href="/forgot">
                                                    <span class="signup">Forgot?</span>
                                                    <span class="login hidden"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('footer_js')
    <script>
        $(document).ready(function () {
            var id_selector_card_animate = $("#card-animate");
            var id_selector_card_animate_f = $("#card-animate-f");
            
            $(".card-left").click(function () {
                
                $('.card-body').fadeOut(250).promise().done(function () {
                    $(this).fadeIn(1500);
                });
                
                if (!id_selector_card_animate.hasClass('move')) {
                    id_selector_card_animate.addClass('move').animate({right: "+=430px"}, 1000);
                    id_selector_card_animate_f.animate({left: "+=460px"}, 1000);
                    id_selector_card_animate_f.css({'z-index': '1000'});
                    id_selector_card_animate.css({'z-index': '2000'});
                    $(".login").removeClass('hidden');
                    $(".signup").addClass('hidden');
                    $("#name").removeClass('hidden');
                    $("#input-name").removeAttr('disabled');
                    // $(".card-animate").removeClass('ml-n-30');
                    $("#form").removeClass('form-right');
                    $("#form").addClass('form-left');
                    
                }
            });
            
            $(".card-right").click(function () {
                $('.card-body').fadeOut(250).promise().done(function () {
                    $(this).fadeIn(1500);
                });
                
                id_selector_card_animate.removeClass('move').animate({right: "0"}, 1000);
                id_selector_card_animate_f.animate({left: "0"}, 1000);
                $(".login").addClass('hidden');
                $(".signup").removeClass('hidden');
                $("#name").addClass('hidden');
                $("#input-name").attr('disabled', 'disabled');
                $("#form").removeClass('form-left');
                $("#form").addClass('form-right');
            });
        });
    </script>
@endpush