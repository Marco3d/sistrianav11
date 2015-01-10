<?php session_start();
 require_once 'class/principal.php';
  if (isset($_SESSION["iddocentes"]) and isset($_SESSION["usudocente"])) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php
$Pagina = "INICIO";
 include 'includes/head.php' ?>




 
</head>
<body>
  <?php include 'includes/navbar.php' ?>



<div class="main">
    <div class="main-inner">
      <div class="container">

<!-- titulo de la página -->
        <!--  <div class="row">
                    <div class="span12">
                        <h2>Inicio</h2>
                     <div> 
          </div>

          <hr> -->

<!-- Comienzo del Contenido Dinamico-->

           <div class="row">
                    <div class="span12">
                        <h2>Inicio</h2><br>

                        <!-- /widget --> 
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Mensajes del Sistema</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="news-items">
                <li>
                  
                  <div class="news-item-date"> <span class="news-item-day">13</span> <span class="news-item-month">Enero</span> </div>
                  <div class="news-item-detail"><b> Aviso del Sistema No 1</b>
                    <p class="news-item-preview"> Versión Número 1.0 del Sistema de Información unificado del Iedit Rodrigo De Triana. Plataforma desarrollada por @ulaRED. Todos los derechos reservados </p>
                  </div>
                  
                </li>
               
               
              </ul>
            </div>
                   
                     <div> 

          </div>

 <!-- Final del Contenido Dinamico-->     
    
  
  
      </div> <!-- /container -->    
  </div> <!-- /main-inner -->      
</div> <!-- /main -->

<br>
    
    <?php include 'includes/footer.php' ?>
 
  </body>
</html>
<?php
  } else {
    header("Location: index.php");
  }
?>
