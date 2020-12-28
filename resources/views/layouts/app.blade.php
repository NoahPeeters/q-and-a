<html>
    <header>
        <title>Q&A</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </header>
    <body>
        <h1 class="text-center mt-3 mb-3"><a href="/">Q&A</a></h1>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
