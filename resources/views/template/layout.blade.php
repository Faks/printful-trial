<!doctype html>
<html class="no-js" lang="">
@include('template.header')

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Container -->
<div class="container pt-10">
    @yield('content')
</div>

<footer class="pt-10">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="text-center text-uppercase">@include('template.footer')</h5>
            </div>
        </div>
    </div>
</footer>

</body>

@include('template.script')
</html>
