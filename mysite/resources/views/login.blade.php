<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/style.css" rel="stylesheet">

    <title>Labs</title>
</head>

<body>
    <main><?php
            if (extension_loaded('gd') && function_exists('gd_info')) {
                // echo "PHP GD library is installed on your web server";
            } else {
                echo "PHP GD library is NOT installed on your web server";
            } ?>
            <div>
                <form action="/login" method="post">
                    @csrf
                    <div>
                        <h1>Login</h1>
                        <div>
                            <label for="login">Login</label>
                            <input id="login" name="login" type="text" placeholder="User">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" placeholder="*********">
                        </div> 
                    </div>
                    <button class="btn btn-primary signIn" type="submit">Войти</button>
                </form> 
            </div>  
            <a href="/registration" type="button">Зарегестрироваться</a>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</body>
</html>
