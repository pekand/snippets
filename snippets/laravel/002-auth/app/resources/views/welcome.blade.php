<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <title>Links</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <style>
    </style>
    
</head>
<body>
    

    <main>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    @foreach ($links as $link)
                        <a href="{{ $link->url }}">{{ $link->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" >
    
    </script>
    
</body>
</html>

