<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>Sombrerro | Rejestracja</title>
        <link rel="stylesheet" href="../zasoby/css/login.css"/>
    </head>
    <body>
        <?php
            require('db.php');
            // When form submitted, insert values into the database.
            if (isset($_REQUEST['username'])) {
                // removes backslashes
                $username = stripslashes($_REQUEST['username']);
                //escapes special characters in a string
                $username = mysqli_real_escape_string($con, $username);
                $name    = stripslashes($_REQUEST['name']);
                $name    = mysqli_real_escape_string($con, $name);
                $email    = stripslashes($_REQUEST['email']);
                $email    = mysqli_real_escape_string($con, $email);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($con, $password);
                $create_datetime = date("Y-m-d H:i:s");
                $query    = "INSERT into users (name, username, password, email, create_datetime)
                            VALUES ('$name', '$username', '" . password_hash($password, PASSWORD_BCRYPT) . "', '$email', '$create_datetime')";
                $result   = mysqli_query($con, $query);
                if ($result) {
                    echo "<script>
                            alert('Pomyślnie zarejestrowano!.');
                            window.location.href = 'login.php';
                        </script>";
                } else {
                    echo "<div class='form'>
                            <h3>Uzupełnij wszystkie wymagane pola.</h3><br/>
                        <p class='link'>Kliknij <a href='registration.php'>tutaj</a> aby się zarejestrować.</p>
                        </div>";
                }
            } else {
        ?>
            <form class="form" action="" method="post">
                <center>
                    <img src="../zasoby/zdjecia/logo.png" alt="" class="img img-fluid">
                </center>
                <hr />
                <h1 class="login-title">Zarejestruj się</h1>
                <input type="text" class="login-input" name="name" placeholder="Imię" required />
                <input type="text" class="login-input" name="username" placeholder="Login" required />
                <input type="text" class="login-input" name="email" placeholder="Email" required>
                <input type="password" class="login-input" name="password" placeholder="Hasło" required>
                <input type="submit" name="submit" value="Zarejestruj się" class="login-button">
                <p class="link">Posiadasz już konto? <a href="login.php">Zaloguj się!</a></p>
            </form>
        <?php
            }
        ?>
    </body>
</html>