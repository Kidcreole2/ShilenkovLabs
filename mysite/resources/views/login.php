<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                <form class="form__signIn" id="signIn">
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
                    <button class="btn btn-primary signUp" type="button">Зарегестрироваться</button>
                </form>
                <form class="form__signUp" id="signUp">
                    <h1>Registration</h1>
                    <div>
                        <label for="login1">Login</label>
                        <input id="login1" name="login1" type="text" placeholder="User">
                    </div>
                    <div>
                        <label for="password1">Password</label>
                        <input id="password1" name="password1" type="password" placeholder="*********">
                    </div> 
                </div>
                    <button class="btn btn-primary signIn" type="button">Войти</button>
                    <button class="btn btn-primary signUp" type="submit">Зарегестрироваться</button>
                </form>
            </div>
            </div>  
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="/js/login.js"></script>
</body>

</html>
