<?php
require_once("include/initialize.php");
?>
    <?php
if (isset($_SESSION['WAITER_USERID'])) {
    redirect("index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="Restaurant free app">
        <meta name="keywords" content="restaurant,app,free">
        <meta name="author" content="iberi@gmail.com">

    <title>
        Gusto y sabor Restaurante.
    </title>
    <link rel="icon" href="favicon-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="admin/css/style.css">

</head>
<body>
    <div class="maindiv">

        <div class="sondiv">
            <form  class="form-4" action="" method="POST" >
                <h1>Inicio de Session</h1>
                <p>
                    <label for="login">Nombre de usuario</label>
                    <input type="text" name="user_email" placeholder="Nombre de usuario" required>
                </p>
                <p>
                    <label for="password">Contraseña</label>
                    <input type="password" name="user_pass" placeholder="Contraseña" required>
                </p>

                <p>
                    <input type="submit" name="btnLogin"  value="Iniciar">
                </p>
            </form>​
        </div>
    </div>



   <!-- <form class="form-1" action="" method="POST">
        <p class="field">
            <input type="text" name="login" placeholder="Username or email">
            <i class="icon-user icon-large"></i>
        </p>
            <p class="field">
            <input type="password" name="password" placeholder="Password">
            <i class="icon-lock icon-large"></i>
        </p>
        <p class="submit">
            <button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
        </p>
    </form> -->

</body>
</html>
        <?php
if (isset($_POST['btnLogin'])) {
    $email   = trim($_POST['user_email']);
    $upass   = trim($_POST['user_pass']);
    $h_upass = sha1($upass);
    if ($email == '' OR $upass == '') {
        message("Usuario o contraseña invalido!", "error");
        redirect("login.php");
    } else {
        //it creates a new objects of member
        $user = new User();
        //make use of the static function, and we passed to parameters
        $res  = $user::userAuthentication($email, $h_upass);
        if ($res == true) {
            if ($_SESSION['ROLE'] == 'Waiter') {
                $_SESSION['WAITER_USERID']   = $_SESSION['USERID'];
                $_SESSION['WAITER_FULLNAME'] = $_SESSION['FULLNAME'];
                $_SESSION['WAITER_USERNAME'] = $_SESSION['USERNAME'];
                $_SESSION['WAITER_ROLE']     = $_SESSION['ROLE'];
                unset($_SESSION['USERID']);
                unset($_SESSION['FULLNAME']);
                unset($_SESSION['USERNAME']);
                unset($_SESSION['PASS']);
                unset($_SESSION['ROLE']);
                message("You logon as " . $_SESSION['WAITER_ROLE'] . ".", "success");
                redirect("index.php");
            } else {
                $_SESSION['ADMIN_USERID']   = $_SESSION['USERID'];
                $_SESSION['ADMIN_FULLNAME'] = $_SESSION['FULLNAME'];
                $_SESSION['ADMIN_USERNAME'] = $_SESSION['USERNAME'];
                $_SESSION['ADMIN_ROLE']     = $_SESSION['ROLE'];
                unset($_SESSION['USERID']);
                unset($_SESSION['FULLNAME']);
                unset($_SESSION['USERNAME']);
                unset($_SESSION['PASS']);
                unset($_SESSION['ROLE']);
                message("Te logueaste como " . $_SESSION['ADMIN_ROLE'] . ".", "success");
                redirect("admin/index.php");
            }
        } else {
            message("¡La cuenta no existe! Por favor, póngase en contacto con el administrador.", "error");
            redirect("login.php");
        }
    }
}
?>