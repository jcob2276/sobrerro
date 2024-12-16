<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Sombrerro | Login </title>
    <link rel="stylesheet" href="../zasoby/css/login.css" />
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
    <?php
    require('db.php');
    session_start();
    // Kiedy formularz zostanie przesłany
    if (isset($_POST['username'])) {
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);

        // Pobierz dane użytkownika na podstawie username
        $query = "SELECT * FROM `users` WHERE username='$username'";
        $result = mysqli_query($con, $query);
        $user = mysqli_fetch_assoc($result);

        // Sprawdź poprawność hasła
        if ($user && password_verify($password, $user['password'])) {
            // Zalogowanie - ustawienie sesji
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            // Błąd logowania
            echo "<div class='form'>
                <h3>Niepoprawny Login/Hasło.</h3><br/>
                <p class='link'>Jeśli masz już konto kliknij <a href='login.php'>tutaj</a></p>
              </div>";
        }
    } else {

        ?>
        <form class="form" method="post" name="login">
            <center>
                <img src="../zasoby/zdjecia/logo.png" alt="" class="img img-fluid">
            </center>
            <hr />
            <h1 class="login-title">Logowanie</h1>
            <input type="text" class="login-input" name="username" placeholder="Login" autofocus="true" />
            <input type="password" class="login-input" name="password" placeholder="Hasło" />
            <input type="submit" value="Zaloguj się" name="submit" class="login-button" />
            <p class="link">Nie masz jeszcze konta? <a href="registration.php">Zarejestruj się!</a></p>
            <hr />

            <div id="g_id_onload" data-client_id="838321752460-6ah497tdpkbekj7lfj5so48suaqhu1e7.apps.googleusercontent.com"
                data-context="signin" data-ux_mode="popup" data-login_uri="https://kapetanncoffeeshop.infinityfreeapp.com"
                data-auto_prompt="false">
            </div>

            <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"
                data-text="signin_with" data-size="large" data-logo_alignment="center" data-callback="onSignIn">
            </div>
        </form>
        <?php
    }
    ?>

    <script src="js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        function onSignIn(googleUser) {
            // Get the user ID token
            var id_token = googleUser.getAuthResponse().id_token;

            // Send the token to the server using AJAX
            $.ajax({
                type: 'POST',
                url: 'set_session.php',
                data: { id_token: id_token },
                success: function (response) {
                    // Redirect to the index.php page
                    window.location.href = 'index.php';
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
</body>

</html>