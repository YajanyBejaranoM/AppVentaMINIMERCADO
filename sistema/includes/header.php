<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
<header>
 
            <div class="header">

                <h1 style="font-size:56px; padding:20px 0 20px 0; " > Sistema de Ventas</h1>

                 <div class="optionBar">
                   <p style="font-size:22px ; margin-left:10px "> Colombia, <?php echo fecha(); ?>   | 
                   <span class="user" style="font-size:22px; margin-left:1px"><i class="fas fa-user-circle" style="color:green"></i> <?php echo $_SESSION['nombusu']; ?><?php $_SESSION['rol'] ; ?> </span>
                   <span> </span>
                    <!--<img class="photouser" src="img/" alt="Usuario">-->
                    <a href="salir.php" style=" margin-left:10px"> <i class="fas fa-power-off fa-2x"></i></a>
                    </p>
                </div>
            </div>
            <?php include("nav.php"); ?>
</header>