<?php
require_once("class/class.php");
include("cabezera.html");

session_start();
if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");

}

?>




<body>
      

        <script type="text/JavaScript" language="javascript">
          function confirmar ( mensaje ) {
          return confirm( mensaje );
         }
        </script>


       <div class="container">
            <ul id="gn-menu" class="gn-menu-main">
                <li class="gn-trigger">
                    <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
                    <nav class="gn-menu-wrapper">
                        <div class="gn-scroller">
                            <ul class="gn-menu">
                                <li class="gn-search-item">
                                    <input placeholder="Search" type="search" class="gn-search">
                                    <a class="gn-icon gn-icon-search"><span>Supervisores</span></a>
                                </li>
                                <li>
                                    <a><img src=Draw/usuario-corporativo.png style=" width:30px; height:30px; margin-left: 10px;">&nbsp;&nbsp; Supervisores</a>
                                   
                                </li>
                                <li><a href="personal.php"><img src=Draw/personal1.png style=" width:30px; height:30px; margin-left: 10px;">&nbsp;&nbsp; Personal</a></li>
                                <li><a href="especializaciones.php" ><img src=Draw/especializaciones.png style=" width:30px; height:30px; margin-left: 10px;">&nbsp;&nbsp; Especializaciones</a></li>
                                <li>
                                    <a href="tareas.php?id_tarea=TODAS & id_supervisor=TODOS & filtro=TODOS"><img src=Draw/tareas.png style=" width:30px; height:30px; margin-left: 10px;">&nbsp;&nbsp; Tareas</a>
                                   
                                </li>

                                <li>
                                    <a href="tareas.php?id_tarea=TODAS & id_supervisor=TODOS & filtro=3"><img src=Draw/tildeverde.png style=" width:30px; height:30px; margin-left: 50px;">&nbsp;&nbsp; Tareas Finalizadas</a>
                                   
                                </li>
                                  <li>
                                    <a href="tareas.php?id_tarea=TODAS & id_supervisor=TODOS & filtro=2"><img src=Draw/tildeamarillo.png style=" width:30px; height:30px; margin-left: 50px;">&nbsp;&nbsp; Tareas en Curso</a>
                                   
                                </li>
                                  <li>
                                    <a href="tareas.php?id_tarea=TODAS & id_supervisor=TODOS & filtro=1"><img src=Draw/trespuntos.png style=" width:30px; height:30px; margin-left: 50px;">&nbsp;&nbsp; Tareas Pendientes</a>
                                   
                                </li>




                                 <li>
                                                                       
                                </li>

                                </br>
                                </br>
                                </br>
                                </br>
                               
                                

                           
                                    <a style="font-weight: bold"><img src=Draw/river_ultimo_50.png style=" width:60px; height:72px; margin-left: 10px;">&nbsp;&nbsp;Club Atletico River Plate</a>

                                    
                                </br>



                         </ul>
                        </div><!-- /gn-scroller -->
                    </nav>
                </li>

                <?php 
                            
                $tra=new trabajo();
                $resultado=$tra->traigo_supervisores("TODOS");
                   
                for($i=0; $i<sizeof($resultado); $i++){
                                    
                    
                    if ($i <= 1) {  ?>
                      <li><a href="tareas.php?id_tarea=TODAS & id_supervisor=<?php  echo $resultado[$i]['Id_Supervisor'] ?> & filtro=TODOS"><img src=Draw/usuario-corporativo.png style=" width:30px; height:30px; margin-left: 10px;">&nbsp;&nbsp;<?php  echo $resultado[$i]["NombreApellido"] ?> </a></li>
                    <?php } else {  ?>

                      <li><a href="tareas.php?id_tarea=TODAS & id_supervisor=<?php  echo $resultado[$i]['Id_Supervisor'] ?> & filtro=TODOS"><span><img src=Draw/usuario-corporativo.png style=" width:30px; height:30px; margin-left: 10px;">&nbsp;&nbsp;<?php  echo $resultado[$i]["NombreApellido"] ?></span></a></li> <?php 
                    }
     
             
                }

                ?>

               <li ><a class="codrops-icon codrops-icon-drop" href="logout.php"><span style="font-size:14px;" ><img src=Draw/usuario1.png style=" width:35px; height:35px; margin-left: 10px;">&nbsp;&nbsp;<?php  echo "Bienvenido ".Trim($_SESSION['nombreusuario']); ?> &nbsp;&nbsp; <?php echo '- CERRAR SESIÓN -'; ?></span></a></li>
           
              

            </ul>
           
        </div><!-- /container -->
      

        <script src="js/classie.js"></script>
        <script src="js/gnmenu.js"></script>
        <script>
            new gnMenu( document.getElementById( 'gn-menu' ) );
        </script>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scroll.js"></script>
</body>

</html>