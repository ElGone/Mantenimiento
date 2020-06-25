<?php

require("principalsinvertical.php");
require_once("class/class.php");
date_default_timezone_set('America/Argentina/Buenos_Aires');

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}


try {

    // verifico busqueda
    $tra=new trabajo();
    $post = (isset($_POST['opcionbusquedapersonal']) && !empty($_POST['opcionbusquedapersonal']));
    if ($post ) {
        if ($_POST['opcionbusquedapersonal']=="nombre"){
            $valor1=$_POST['nompersonal'];
            $resultado=$tra->traigo_personal("2",$valor1);}
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
  <div class="col" >    
                 
   <a style="border:none; color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="cargopersonal.php"><img src=Draw/agregar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Agregar Personal
   </a>

   </div>
        
       
        <div class="col">  </div>
        <div class="col"> <label style="font-weight: bold; font-size:28px;" class="control-label">Lista del Personal</label></div>
        <div class="col">  </div>
       
 
    

 
  <div class="col" >  
       <a style="border:none; color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
       <span class="oi oi-trash" aria-hidden="true"></span>Volver al Menu
       </a>
  </div>   
</div>

  <hr />


    
<form class="form-inline" method="post" action="buscopersonal.php">
     
<div class="col"  style="width:33.33%; text-align:left;">  
          <div class="row" style="width:100%; margin-left:15px;">
            <label style="font-size:20px;">Buscar Personal por..</label>
          </div>
        </div>



      <div class="col"  style="width:33.33%; text-align:center;"> 
      <div class="row" style="width:100%; text-align:center;">
              <label style="font-weight: bold;">
                <input  type="radio" name="opcionbusquedapersonal" value="nombre"> &nbsp;&nbsp;Ingrese el Nombre del Personal              </label>   &nbsp;&nbsp;       
             <input name="nompersonal" type="text" class="form-control" style="width:250px; margin-top:-7px;" placeholder="Nombre del Personal">
      </div>          
      </div> 

    

        
       
      <div class="col"  style="width:33%; text-align:left;">    
      <div class="row" style="width:100%">      
          <button type="submit" name="valor" value="Buscar" style="margin-top:-7px; background-color: white; border:none;font-weight: bold; font-size:20px; ">
          <img src=Draw/buscar.png style=" width:30px; height:30px;"> Buscar
          </button>
      </div>    
      </div>
     
     
</form>


  <hr />

   
   <div style="height: 880px;" class="scrollable">  
     <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Disponible</th>
                    <th scope="col">Personal Numero</th>
                    <th scope="col">Nombre y Apellido</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Finalizar Trabajos</th>
                    <th scope="col">Historial</th>
                    <th scope="col">Edicion</th>

                </tr>
            </thead>
            <tbody>

                        <?php 
                        $hoy=date("Y-m-d");
                        $sintrabajos=1;
                        $hora_actual = date("H:i:s");
                                             
                        for($i=0; $i<sizeof($resultado); $i++){
                         ?>
                            <tr> 
                            <td><img src=Draw/personal1.png style=" width:50px; height:50px"></td>
                                  <?php 

                                   $resultado1=$tra->traigo_personal_activo($resultado[$i]["Id_Personal"],$hoy,$hora_actual);
                                   $row_cnt = count($resultado1);
                                   if ($row_cnt==0){
                                    ?>
                                    <td><img src=Draw/cruz.png style=" width:35px; height:35px"></td>  <?php $sintrabajos=2; } else { ?>
                                    <td><img src=Draw/tildeok.png style=" width:30px; height:30px"></td> <?php $sintrabajos=1;}
                                    ?>                            
                            <th scope="row"><?php  echo $resultado[$i]["Id_Personal"] ?> </th>
                            <td style="font-weight: bold;">
                         <?php 
                            echo $resultado[$i]["NombreApellido"] ;
                         ?> 
                           </td>

                           <td>
                           <?php 
                             $tra=new trabajo(); 
                             $especialidad=$tra->traigo_especialidad($resultado[$i]["Especialidad"]);
                             for($w=0; $w<sizeof($especialidad); $w++) { ?>
                             <img src="<?php echo $especialidad[$w]["Logo"]; ?>" style="width:30px; height:30px;">&nbsp; <?php echo trim($especialidad[$w]["Descripcion"]); }
                              ?>

                             </td>

                             <?php 

                             if ($sintrabajos ==2){
                                    ?>
                              <td>                               
                                <a style="color:#4B0082; font-weight: bold;" class="nav-link" href="finalizartrabajos.php?idpersonal=<?php echo $resultado[$i]["Id_Personal"]; ?>">
                                    <span class="oi oi-pencil" aria-hidden="true"><img src=Draw/tildeamarillo.png style=" width:30px; height:30px"></span>&nbsp;&nbsp; Finalizar Trabajos
                                </a>
                             <?php } else { ?>
                              <td>
                              
                                    <span class="oi oi-pencil" aria-hidden="true"><img src=Draw/tildeverde.png style=" width:30px; height:30px"></span>&nbsp;&nbsp; Sin trabajos Pendientes
                                <?php

                             }   ?>
                           
                          </td>     

                          <td>
                               <a style="color:#4B0082; font-weight: bold;" class="nav-link" href="tareas.php?id_tarea=TODAS & id_supervisor=TODOS & filtro=3 & id_personal=<?php echo $resultado[$i]["Id_Personal"]; ?>">
                               <span class="oi oi-pencil" aria-hidden="true"><img src=Draw/historial1.png style=" width:30px; height:30px"></span>&nbsp;&nbsp; Historial de Tareas

                          </td>
      
                            
                          
                          
                          
                       
                          <td>
                            <a style="color:#4B0082;" class="nav-link" href="editpersonal.php?idpersonal=<?php echo $resultado[$i]["Id_Personal"]; ?>">
                                <span class="oi oi-pencil" aria-hidden="true"><img src=Draw/editar.png style=" width:30px; height:30px"></span>&nbsp;&nbsp; Editar
                            </a>
                            <a style="color:#4B0082;" class="nav-link" href="#"><img src=Draw/baja.png style=" width:30px; height:30px">
                                <span class="oi oi-trash" aria-hidden="true"></span>&nbsp;&nbsp; Dar de Baja
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