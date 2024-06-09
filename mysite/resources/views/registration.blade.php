<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/style.css" rel="stylesheet">

    <title>Labs</title>
</head>

<body>
    <main>
                <form action="/registration" method="post">
                    @csrf
                    <h1>Registration</h1>
                    <div>
                        <label for="login">Login</label>
                        <input id="login" name="login" type="text" placeholder="User">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" placeholder="*********">
                    </div> 
                    <div>
                        <label for="name">Password</label>
                        <input id="name" name="name" type="text" placeholder="John">
                    </div> 
                </div>
                    <button class="btn btn-primary signUp" type="submit">Зарегестрироваться</button>
                </form>
                <a href="/login" type="button">Войти</a>
            </div>
            </div>  
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</html>
