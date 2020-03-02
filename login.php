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
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="web_index/css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <!-- //fonts -->
    <link rel="stylesheet" href="web_index/css/font-awesome.min.css" type="text/css" media="all">
    <!-- //Font-Awesome-File-Links -->

    <!-- Google fonts -->
    <link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
    <!-- Google fonts -->
</head>

<body>
    <!-- <div class="maindiv">

        <div class="sondiv">
            <form class="form-4" action="" method="POST">
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
                    <input type="submit" name="btnLogin" value="Iniciar">
                </p>
            </form>​
        </div>
    </div> -->
    <section class="main">
        <div class="layer">

            <div class="bottom-grid">
                <div class="logo">
                    <h1> <a href="index.php"><span class="fa fa-key"></span> MyRestaurant</a></h1>
                </div>
                <div class="links">
                    <ul class="links-unordered-list">
                        <li class="">
                            <a href="#" class="">About Us</a>
                        </li>
                        <li class="">
                            <a href="#" class="">Register</a>
                        </li>
                        <li class="">
                            <a href="#" class="">Contact</a>
                        </li>
                        <li class="active">
                            <a href="#" class="">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-w3ls">
                <div class="text-center icon">
                    <span class="htmls3"></span>
                </div>
                <div class="content-bottom">
                    <form action="#" method="post">
                        <div class="field-group">
                            <span class="fa fa-user" aria-hidden="true"></span>
                            <div class="wthree-field">
                                <input name="user_email" placeholder="Nombre de usuario" id="text1" type="text" value="" required>
                            </div>
                        </div>
                        <div class="field-group">
                            <span class="fa fa-lock" aria-hidden="true"></span>
                            <div class="wthree-field">
                                <input name="user_pass" placeholder="Contraseña" id="myInput" type="Password">
                            </div>
                        </div>
                        <div class="wthree-field">
                            <!-- <input type="submit" class="btn" name="btnLogin" value="Iniciar"> -->
                            <button type="submit" name="btnLogin" class="btn">Iniciar</button>
                        </div>
                        <!-- <ul class="list-login">
                            <li class="switch-agileits">
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                    Matener logueado
                                </label>
                            </li>
                            <li>
                                <a href="#" class="text-right">Olvido su contraseña?</a>
                            </li>
                            <li class="clearfix"></li>
                        </ul> -->
                        <!-- <ul class="list-login-bottom">
                            <li class="">
                                <a href="#" class="">Create Account</a>
                            </li>
                            <li class="">
                                <a href="#" class="text-right">Need Help?</a>
                            </li>
                            <li class="clearfix"></li>
                        </ul> -->
                    </form>
                </div>
            </div>
            <div class="bottom-grid1">
                <div class="links">
                    <ul class="links-unordered-list">
                        <li class="">
                            <a href="#" class="">About Us</a>
                        </li>
                        <li class="">
                            <a href="#" class="">Privacy Policy</a>
                        </li>
                        <li class="">
                            <a href="#" class="">Terms of Use</a>
                        </li>
                    </ul>
                </div>
                <div class="copyright">
                    <p> © 2019 MyRestaurant. All rights reserved |
                        <!-- Design by
                        <a href="http://w3layouts.com">W3layouts</a> -->
                    </p>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
<?php
if (isset($_POST['btnLogin'])) {
    $email   = trim($_POST['user_email']);
    $upass   = trim($_POST['user_pass']);
    $h_upass = sha1($upass);
    if ($email == '' or $upass == '') {
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