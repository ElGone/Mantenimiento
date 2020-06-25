<?php
require("principalsinvertical.php");
require_once("class/class.php");
date_default_timezone_set('America/Argentina/Buenos_Aires');

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}


$filtro=$_GET['filtro'];

?>



<header>


<div style="width: 100%; background-color: white; margin-top:60px; border: DarkSlateGray 5px double">
        <br />

        <h2 style="margin-left:30px; font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;"><img src=Draw/tareas.png style=" width:50px; height:50px">&nbsp;&nbsp; Carga de Tareas - Sector Mantenimiento</h2>


      
         <hr />

        <form  method="post" style="margin-left:3px;"action="ingresotarea.php">



          <div class="row">
              <div class="col">
                 <label for="Supervisor" class="control-label" style="margin-left:50px; font-weight: bold;">Supervisor</label>
                            <select name="supervisor" id="supervisor" style="width:350px;margin-left:30px;" class="form-control line vld draw" margin-left:180px;>
                              <option value="0">Seleccionar Supervisor</option>
                               <?php 
                             $tra=new trabajo();
                             $supervisor=$tra->traigo_supervisores("TODOS");
                             for($w=0; $w<sizeof($supervisor); $w++){
                            ?>
                               <option value="<?php echo $supervisor[$w]["Id_Supervisor"]; ?>"><?php echo $supervisor[$w]["NombreApellido"]; ?></option> 
                                <?php 
                                }
                                ?>
                            </select>
                  
              </div>
 

               <div class="col">
                        <label class="control-label" style="margin-left:10px; font-weight: bold;">Nombre de la Tarea</label>
                        <input name="nomtarea" class="form-control line vld draw" style="width:300px; margin-left:10px; text-align: center" />
              </div>

             <div class="col">
                <label style="margin-left:10px; display:block; font-weight: bold;" class="control-label">Fecha de Comienzo</label>
                <input class="form-control line vld draw" type="date" name="tareadiacomienzo" style="margin:.4rem 0; width:200px; margin-left:10px;" value="<?php echo date('Y-m-d');?>">
              </div>

              <div class="col">
                <label style="margin-left:10px; display:block; font-weight: bold;" class="control-label">Fecha de finalización</label>
                <input class="form-control line vld draw" type="date" name="tareadiafin" style="margin:.4rem 0; width:200px; margin-left:10px;" value="<?php echo date('Y-m-d');?>">
              </div>

         </div>

           <hr />



       <div style="margin-left:10px;" class="row">
         <hr />
         <hr />
        <div class="col">
                <label style="margin-left:10px;" class="control-label" style="display:block">Seleccion de Personal</label>
           <div style="height: 290px;" class="scrollable">  
               <table class="table">
                      <thead class="thead-dark">
                          <tr>
                             <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col">Numero</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Especialidad</th>
                              <th scope="col">Fecha Inicio</th>
                              <th scope="col">Hora Inicio</th>
                              <th scope="col">Fecha Final</th>
                              <th scope="col">Hora Final</th>
                              <th scope="col"></th>
                             
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                                   
                                   $hoy=date("Y-m-d");
                                   $hora_actual = date("H:i:s");
                                   $tra=new trabajo();
                                   $resultado=$tra->traigo_personal_activo("TODOS",$hoy,$hora_actual);
                                   $cont=0;

                                   for($i=0; $i<sizeof($resultado); $i++){
                                   ?>
                                   <tr> 
                                      <td><img src=Draw/Personal.png style=" width:20px; height:20px"></td>

                                       <th scope="row"><input type="checkbox" name="check_personal[]" value=<?php  echo $resultado[$i]["Id_Personal"]."-".$cont; ?> ></th>
                                      <th scope="row"><?php  echo $resultado[$i]["Id_Personal"] ?> </th>
                                      <td>
                                   <?php 
                                      echo $resultado[$i]["NombreApellido"] ;
                                   ?> 
                                     </td>
                                     
                                      <?php 
                                      $tra=new trabajo();
                                      $icono=$tra->traigo_especialidad($resultado[$i]["Especialidad"]); ?> 
                                      <td><img src="<?php echo $icono[0]["Logo"]; ?>" style="width:20px; height:20px">

                                      <?php 
                                        echo $resultado[$i]["Especialidad"] ;
        

                                      ?>
                              
                                     </td>

                                     <td>
                               
                                    <input name="check_diadesde[]" class="form-control line vld draw" type="date"  id="start" style="margin:.4rem 0; width:170px; margin-left:30px;" value="<?php echo date('Y-m-d');?>">

                                      </td>

                                        <td>
                               
                                    <input name="check_horadesde[]" class="form-control line vld draw" type="time" m id="start" style="margin:.4rem 0; width:150px; margin-left:30px;" >

                                      </td>

                                      <td>
                               
                                     <input name="check_diafin[]" class="form-control line vld draw" type="date"  id="start"  style="margin:.4rem 0; width:170px; margin-left:30px;"value="<?php echo date('Y-m-d');?>" >

                                      </td>

                                       <td>
                               
                                    <input name="check_horafin[]" class="form-control line vld draw" type="time"  id="start" style="margin:.4rem 0; width:150px; margin-left:30px;">

                                      </td>

                                     
                                    </tr>
                                  <?php 
                                   $cont=$cont +1;
                                   }
                                   ?>

                                </tbody>


                  </table>
          </div> 
</div>

</div>
 
 <hr />
     



  <div style="width:100%;" class="row">
    
    <div class="col"  style="margin-left:70px; width:35%;" >
         <label style="font-weight: bold;" class="control-label" >Descripción de la Tarea</label>
         <textarea  placeholder="Describa los pasos a seguir en la Tarea" name="destarea" rows="5" cols="55" wrap="soft"></textarea>
    </div>

 
    <div class="col" style="margin-left:10px; width:35%;">
         <label style="font-weight: bold;" class="control-label" >Descripción de Materiales</label>
         <textarea  placeholder="Ingrese los materiales necesarios para esta Tarea" name="desmateriales" rows="5" cols="55" wrap="soft"></textarea>
    </div>

      <div class="col" style="margin-left:10px;  width:30%;">
                 <label  class="control-label" style="font-weight: bold;">Estado</label>
                            <select name="estado_tarea" id="estado_tarea" style="width:370px;margin-left:30px;" class="form-control line vld draw" margin-left:180px;>
                              <option value="0">Seleccionar Estado</option>
                               <?php 
                             $tra=new trabajo();
                             $estado=$tra->traigo_estado_tarea("TODAS");
                             for($w=0; $w<sizeof($estado); $w++){
                            ?>
                               <option value="<?php echo $estado[$w]["Id_EstadoTareas"]; ?>"><?php echo $estado[$w]["Descripcion"]; ?></option> 
                                <?php 
                                }
                                ?>
                            </select>
                  
              </div>



</div>


<hr />



  

<div class="row">

<div class="col" style="width:50%; text-align:left">     
    <a style="color:#4B0082; font-weight: bold; font-size:18px; margin-left:5px;" class="nav-link" href="cargotarea.php" data-toggle="modal" data-target="#modal1"><img src=Draw/agregar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Cargar Tarea
  </a>
</div>


 <div class="col" style="width:50%; text-align:right">     
    <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="tareas.php?id_tarea=TODAS & id_supervisor=TODOS & filtro=<?php echo $filtro; ?>"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Volver al Menu
 </div>   


 


</div>



<div class="form-group col-md-4">
           </div>
           
       

          <div class="modal fade" id=modal1>
            <div class="modal-dialog">
              <div class="modal-content">
                <div  class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                  <h5 class="modal-title">Carga de Tareas de Mantenimiento</h5>
                </div> 

               <div class="modal-body">
                  Esta seguro que desea dar de alta esta nueva tarea ?
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                   <input type="submit" class="btn btn-danger" value="Cargar Tarea" data-toggle="modal" data-target="#modal1"/>
                  
 
                </div>
            


              </div>
            </div>
          </div>

               

      


          
         

        </form>
     
    </div>

</header>
</html>








  

