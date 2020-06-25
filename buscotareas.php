<?php
require_once("class/class.php");
require("principalsinvertical.php");

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}


$idtarea=$_GET['idtarea'];
$idsupervisor=$_GET['idsupervisor'];
$filtro=$_GET['filtro'];
try {

// verifico busqueda
$tra=new trabajo();
$post = (isset($_POST['opcionbusquedatarea']) && !empty($_POST['opcionbusquedatarea']));
if ($post ) {
	if ($_POST['opcionbusquedatarea']=="tarea"){
        $valor1=$_POST['ntarea'];
        $valor2="";
		$mibusqueda=$tra->busco_tarea("1",$valor1, $valor2, $filtro);}
	else if ($_POST['opcionbusquedatarea']=="nombre"){
        $valor1=$_POST['nomtarea'];
        $valor2="";
		$mibusqueda=$tra->busco_tarea("2",$valor1, $valor2,$filtro);}	
	else if ($_POST['opcionbusquedatarea']=="fechas"){
		$valor1=$_POST['fechadesde'];
		$valor2=$_POST['fechahasta'];
		$mibusqueda=$tra->busco_tarea("3",$valor1, $valor2,$filtro);}
} 



}
    
catch (Exception $e) {
    // estado 3 error en la ejecucion
        
    echo $e->getMessage();
                 
}

?>


<header>
<div style="width: 100%; background-color: white; margin-top:60px; border: DarkSlateGray 5px double">

<div class="row">
  <div class="col"  style="width:40%;text-align:left">    
       
   <a style="border:none; color:#4B0082; font-weight: bold; font-size:20px;" class="nav-link" href="cargotarea.php?filtro=<?php echo $filtro; ?>"><img src=Draw/agregar.png style=" width:30px; height:30px;">&nbsp;&nbsp; Nueva Tarea
    
   </a>

  </div>
        
        
      
   <div class="col" style="width: 20%;text-align:center;"> 
   <label style="font-size:40px; text-align: center;font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;" class="control-label">Lista de Tareas</label>
   </div>
       
        
 
    

 
   <div class="col" style="width: 40%; text-align:right;">  
       <a style="border:none; color:#4B0082; font-weight: bold; font-size:20px;" class="nav-link"  href="principal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
       <span class="oi oi-trash" aria-hidden="true"></span>Volver al Menú
       </a>
  </div>   
</div>



   <hr />


   <form class="form-inline" method="post" action="buscotareas.php?idtarea=<?php echo $idtarea; ?>& idsupervisor=<?php echo $idsupervisor; ?> & filtro=<?php echo $filtro; ?>">
     
        <label style="font-size:20px; margin-left:20px;">Buscar Tarea por..</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
        
        <input type="radio" name="opcionbusquedatarea" value="tarea" checked >&nbsp;&nbsp;
        <label style="font-weight: bold;">Nº Tarea</label>&nbsp;          
        <input name="ntarea" value="1" type="number" min="1" class="form-control" style="width:90px;"  placeholder="Numero de Tarea">&nbsp; &nbsp;&nbsp; &nbsp;  
              
        <input  type="radio" name="opcionbusquedatarea" value="nombre">&nbsp;&nbsp; 
        <label style="font-weight: bold;">Tarea</label>&nbsp;&nbsp;           
        <input name="nomtarea" type="text" class="form-control" style="width:250px;" placeholder="Nombre de la Tarea">&nbsp; &nbsp;&nbsp; &nbsp;  
            
                
        <input type="radio" name="opcionbusquedatarea" value="fechas">&nbsp;&nbsp;
        <label style="font-weight: bold;">Fecha. Ini. Desde</label>&nbsp; 
        <input name="fechadesde" class="form-control" type="date" style="width:170px;" value="<?php echo date("Y-m-d");?>">&nbsp;&nbsp;
        <label style="font-weight: bold;">Fecha. Ini. Hasta</label>&nbsp; 
        <input name="fechahasta" class="form-control" type="date" style="width:170px;" value="<?php echo date("Y-m-d");?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
        <button type="submit" name="valor" value="Guardar" style="margin-top:-7px; background-color: white; border:none;font-weight: bold; font-size:20px; ">
        <img src=Draw/buscar.png style=" width:30px; height:30px;"> Buscar
        </button>

     
</form>

   

 

   <hr />
   
  

    <div style="height: 800px;" class="scrollable">  
     <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Tarea Nº</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Supervisor</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Fin</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Ayudantes</th>
                    <th scope="col">Edición</th>

                </tr>
            </thead>

            <tbody>
             

                        <?php 
                        				
                                              
                         for($i=0; $i<sizeof($mibusqueda); $i++){
                         ?>
                         <tr> 
                            <td><img src=Draw/tareas.png style="width:50px; height:50px"></td>

                            <th scope="row"><?php  echo$mibusqueda[$i]["Id_Tarea"] ?> </th>


                            <td style="font-weight: bold;">
                             <?php 
                                echo $mibusqueda[$i]["Nombre_Tarea"] ;
                             ?> 
                            </td>



                            <td><img src=Draw/usuario-corporativo.png style=" width:30px; height:30px">
                            <?php 
                            $tra=new trabajo();
                            $supervisor=$tra->traigo_supervisores($mibusqueda[$i]["Id_Supervisor"]);
                            for($w=0; $w<sizeof($supervisor); $w++){
                                echo $supervisor[$w]["NombreApellido"] ;
                            }
                            ?>
                            </td>


                           <td>
                            <?php 
                           echo $mibusqueda[$i]["Fecha_Comienzo"] ;
                            ?> 
                           </td>

                           <td>
                            <?php 
                           echo $mibusqueda[$i]["Fecha_Fin"] ;
                          ?> 
                           </td>

                            <?php 
                            if ($mibusqueda[$i]["Estado_Tarea"]==3) { ?>
                               <td><img src=Draw/tildeverde.png style=" width:35px; height:35px">  <?php }
                            else if ($mibusqueda[$i]["Estado_Tarea"]==2) { ?>
                              <td><img src=Draw/tildeamarillo.png style=" width:30px; height:30px">  <?php }
                            else if ($mibusqueda[$i]["Estado_Tarea"]==1) { ?>
                              <td><img src=Draw/trespuntos.png style=" width:35px; height:35px">  <?php }
                  
                            $tra=new trabajo();
                            $estadotarea=$tra->traigo_estado_tarea_total($mibusqueda[$i]["Estado_Tarea"]);
                            for($w=0; $w<sizeof($estadotarea); $w++){
                                echo $estadotarea[$w]["Descripcion"] ;
                            }
                                ?>
                           </td>

                           
                              <?php 
                                if ($mibusqueda[$i]["Estado_Tarea"]==3) {  ?>
                                 <td> <a style="color:#4B0082;" class="nav-link" href="verayudantes.php?idtarea=<?php echo $mibusqueda[$i]["Id_Tarea"]; ?>">
                                  <span  class="oi oi-pencil" aria-hidden="true"></span>Ver de Ayudantes
                                  </a>
                              <?php 

                              } else {  ?>

                           
                                 <td> <a style="color:#4B0082; font-weight: bold;" class="nav-link" href="pedidoayudantes.php?idtarea=<?php echo $mibusqueda[$i]["Id_Tarea"]; ?>">
                                  <span  class="oi oi-pencil" aria-hidden="true"></span>Pedido de Ayudantes
                                  </a> <?php 

                               }   ?>
                           </td>     

                          
                       
                        <td>
                           <?php 
                           if ($mibusqueda[$i]["Estado_Tarea"]==3){  ?>
                              <a style="color:#4B0082;"  class="nav-link" href="vertarea.php?idtarea=<?php echo $mibusqueda[$i]["Id_Tarea"]; ?>& idsupervisor=TODOS & filtro=3">
                                <span  class="oi oi-pencil" aria-hidden="true"><img src=Draw/editar.png style=" width:30px; height:30px"></span>Ver Tarea
                            </a>
                             <?php 

                           } else {  ?>

                               <a style="color:#4B0082; font-weight: bold;"  class="nav-link" href="edittarea.php?idtarea=<?php echo $mibusqueda[$i]["Id_Tarea"]; ?> & idsupervisor=TODOS & filtro=<?php echo $mibusqueda[$i]["Estado_Tarea"]; ?>">
                                <span  class="oi oi-pencil" aria-hidden="true"><img src=Draw/editar.png style=" width:30px; height:30px"></span>Editar Tarea
                            </a> <?php 

                           }   ?>

                            
                            <a style="color:#4B0082;"   class="nav-link" href="#"><img src=Draw/baja.png style=" width:30px; height:30px">
                                <span class="oi oi-trash" aria-hidden="true"></span>Dar de Baja Tarea
                            </a>

                        </td>                         
                      
                       </tr>
                        <?php 
                        
                         }
                         ?>


                      </tbody>


        </table>
 </div>

   

</div>
</header>
</html>
