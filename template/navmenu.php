<nav class="side-navbar">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="img/avataruser.png" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
      <h1 class="h4"><?=$_SESSION['name'];?></h1>
      
      <p><?=$_SESSION['rol'];?></p>
    </div>
  </div>
  <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
  <ul class="list-unstyled">
    <li > <a href="index.php"><i class="icon-home"></i>Inicio</a></li>
    <li> <a href="tarjetas.php"> <i class="fa fa-credit-card"></i>Tarjetas</a></li>
    <li> <a href='ordenes.php'> <i class='fa fa-list-alt'></i>Orden de Servicio</a></li>
    <?php if($_SESSION['rol']=="Administrador"){
    echo("<li> <a href='usuarios.php'> <i class='fa fa-user-circle'></i>Usuarios</a></li>");
    echo("<li> <a href='recargas.php'> <i class='fa fa-money'></i>Recargas</a></li>");
    echo("<li> <a href='login.php'> <i class='fa fa-sign-out'></i>Cerrar Sesion</a></li>");
    } 
    ?>
  </ul>
</nav>