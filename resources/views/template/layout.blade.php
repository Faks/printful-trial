<!doctype html>
<html class="no-js" lang="">
@include('template.header')

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">Printful Trial</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                
                @if (request()->segments()['1'] == "admin")
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Main Site</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Dashboard</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/quiz/create">Create Quiz</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Container -->
<main class="container pt-5">
    @yield('content')
</main>

<!-- Footer -->
@include('template.footer')

</body>

@include('template.script')
</html>
