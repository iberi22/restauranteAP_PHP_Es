 <?php
require_once("include/initialize.php");

 ?>
  <?php
 // login confirmation
  if(isset($_SESSION['WAITER_USERID'])){
    redirect("index.php");
  }
  ?>



<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>
  <?php
      $sql = "SELECT * FROM `tbltitle` WHERE TItleID=1";
      $mydb->setQuery($sql);
      $viewTitle = $mydb->loadSingleResult();
      echo $viewTitle->Title;
  ?>

</title>

    <!--<link rel="icon" href="favicon-1.ico" type="image/x-icon">-->

      <link rel="stylesheet" href="admin/css/style.css">


</head>

<body>
  <body>
<div class="container">
  <section id="content">
  <?php check_message(); ?>
    <form action="" method="POST">
      <h1>Login</h1>
      <div>
        <input style="font-size: 15px;" type="text" placeholder="Usaurio..." required="" id="username"  name="user_email" />
      </div>
      <div>
        <input style="font-size: 15px;" type="password" placeholder="Contraseña..." required="" id="password" name="user_pass" />
      </div>
      <div>
        <input style="width: 92%;" type="submit" name="btnLogin" value="Log in"/>
      </div>
    </form><!-- form -->
    <div class="button">
    <a style="font-size: 25px;">
            <?php
                $sql = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                $mydb->setQuery($sql);
                $viewTitle = $mydb->loadSingleResult();
                echo $viewTitle->Title;
            ?>
        </a>
    </div><!-- button -->
  </section><!-- content -->
</div><!-- container -->
</body>



</body>
</html>




 <?php

if(isset($_POST['btnLogin'])){
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
    $res = $user::userAuthentication($email, $h_upass);
    if ($res==true) {
      if ($_SESSION['ROLE']=='Waiter'){

        $_SESSION['WAITER_USERID'] = $_SESSION['USERID'];
        $_SESSION['WAITER_FULLNAME'] = $_SESSION['FULLNAME'] ;
        $_SESSION['WAITER_USERNAME'] =$_SESSION['USERNAME'];
        $_SESSION['WAITER_ROLE'] = $_SESSION['ROLE'];

        unset( $_SESSION['USERID'] );
        unset( $_SESSION['FULLNAME'] );
        unset( $_SESSION['USERNAME'] );
        unset( $_SESSION['PASS'] );
        unset( $_SESSION['ROLE'] );

       message("You logon as ".$_SESSION['WAITER_ROLE'].".","success");
       redirect("index.php");
      }else{

        $_SESSION['ADMIN_USERID'] = $_SESSION['USERID'];
        $_SESSION['ADMIN_FULLNAME'] = $_SESSION['FULLNAME'] ;
        $_SESSION['ADMIN_USERNAME'] =$_SESSION['USERNAME'];
        $_SESSION['ADMIN_ROLE'] = $_SESSION['ROLE'];

        unset( $_SESSION['USERID'] );
        unset( $_SESSION['FULLNAME'] );
        unset( $_SESSION['USERNAME'] );
        unset( $_SESSION['PASS'] );
        unset( $_SESSION['ROLE'] );

         message("Te logueaste como ".$_SESSION['ADMIN_ROLE'].".","success");
         redirect("admin/index.php");
      }
    }else{
      message("¡La cuenta no existe! Por favor, póngase en contacto con el administrador.", "error");
       redirect("login.php");
    }
 }
 }
 ?>



