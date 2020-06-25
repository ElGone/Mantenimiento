<?php
require("principalsinvertical.php");
require_once("class/class.php");

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}


$idtarea=$_GET['idtarea'];
$idsupervisor=$_GET['idsupervisor'];
$filtro=$_GET['filtro'];
date_default_timezone_set('America/Argentina/Buenos_Aires');

?>



<header>

  <script type="text/javascript">
    function c(a)
    {
        a.checked='checked';
    }
</script> 



<div style="width: 100%; background-color: white; margin-top:60px; border: DarkSlateGray 5px double">
        <br />
        
        <h2 style="margin-left:30px; font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;"><img src=Draw/tareas.png style=" width:50px; height:50px">&nbsp;&nbsp; Edición y Modificación de Tareas - Sector Mantenimiento</h2>


        <hr />
  

        <form  style="margin-left:3px;"method="post" action="modificotarea.php?id_tarea=<?php echo $idtarea; ?>& id_supervisor=<?php echo $idsupervisor; ?> & filtro=<?php echo $filtro; ?>">

          <?php
          $tra=new trabajo();
          $mitarea=(string)$idtarea;
          $resultado=$tra->traigo_tareas($mitarea, "TODOS", $filtro);
          error_reporting(E_ALL ^ E_NOTICE);
          for($i=0; $i<sizeof($resultado); $i++){

            ?>

              <div class="row">
                        <div class="col">

                         <label for="Supervisor" class="control-label" style="margin-left:50px;font-weight: bold;">Supervisor</label>
                            <select name="supervisor" id="supervisor" style="width:350px;margin-left:30px;" class="form-control line vld draw" margin-left:180px;>

                              <?php 
                             $tra=new trabajo();
                             $supervisor=$tra->traigo_supervisores($resultado[$i]["Id_Supervisor"]);
                             for($w=0; $w<sizeof($supervisor); $w++){
                               ?>
                               <option value="<?php echo $supervisor[$w]["Id_Supervisor"]; ?>"><?php echo $supervisor[$w]["NombreApellido"]; ?> </option> 
                                <?php 
                                }
                                ?>                        
                             <?php 
                             $tra=new trabajo();
                             $supervisor=$tra->traigo_supervisores("TODOS");
                             for($w=0; $w<sizeof($supervisor); $w++){
                               ?>
                               <option value="<?php echo $supervisor[$w]["Id_Supervisor"]; ?>"><?php echo $supervisor[$w]["NombreApellido"]; ?> </option> 
                                <?php 
                                }
                                ?>                        
                            </select>
                  
                         </div>
 

                         <div class="col">
                            <label class="control-label" style="margin-left:10px;font-weight: bold;">Nombre de la Tarea</label>
                                <input value="<?php echo $resultado[$i]["Nombre_Tarea"]; ?>" name="nomtarea" class="form-control line vld draw" style="width:300px; margin-left:10px; text-align: center" />
                          </div>

                         <div class="col">
                            <label style="margin-left:10px;display:block;font-weight: bold;" class="control-label" >Fecha de Comienzo</label>
                            <input class="form-control line vld draw" type="date" name="tareadiacomienzo" style="margin:.4rem 0; width:200px; margin-left:10px;" value=<?php echo $resultado[$i]["Fecha_Comienzo"]; ?>>
                          </div>

                          <div class="col">
                            <label style="margin-left:10px;display:block;font-weight: bold;" class="control-label" >Fecha de finalización</label>
                            <input class="form-control line vld draw" type="date" name="tareadiafin" style="margin:.4rem 0; width:200px; margin-left:10px;" value=<?php echo $resultado[$i]["Fecha_Fin"]; ?>>
                          </div>

                        </div>

           
               <hr />



              <div style="margin-left:10px;" class="row"> 
                              <div class="col" >
                                      <label style="margin-left:10px;" class="control-label" style="display:block">Seleccion de Personal y Trabajo</label>
                                 <div style="height: 320px;" class="scrollable">  
                                     <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col">Número</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Especialidad</th>
                                                    <th scope="col">Fecha Inicio</th>
                                                    <th scope="col">Hora Inicio</th>
                                                    <th scope="col">Fecha Final</th>
                                                    <th scope="col">Hora Final</th>
                                                    <th scope="col">Estado Personal</th>
                                                    <th scope="col">Estado Supervisor</th>
                                                    <th scope="col">Eliminar</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                       
                                            <?php 
                                     
                                               
                                               $check_baja=array();
                                               $hoy=date("Y-m-d");
                                               $hora_actual = date("H:i:s");
                                               $tra=new trabajo();
                                               $resultado1=$tra->traigo_personal_tarea($idtarea);
                                               $cont=0;
                                               

                                               for($ii=0; $ii<sizeof($resultado1); $ii++){
                                                $percargado[$ii]=$resultado1[$ii]["Id_Personal"]."-".$cont;
                                               ?>
                                               <tr> 
                                                  <td><img src=Draw/Personal.png style=" width:20px; height:20px"></td>

                                                  <th scope="row"><input type="checkbox" onchange="c(this)" onclick="c(this)" name="check_personal[]" value=<?php  echo $resultado1[$ii]["Id_Personal"]."-".$cont; ?> checked ></th>
                                                  <th scope="row"><?php  echo $resultado1[$ii]["Id_Personal"] ?> </th>
                                                  <td>
                                               <?php 
                                                  echo $resultado1[$ii]["NombreApellido"] ;
                                               ?> 
                                                 </td>
                                                  <?php 
                                                  $tra=new trabajo();
                                                  $icono=$tra->traigo_especialidad($resultado1[$ii]["Especialidad"]); ?> 
                                                 <td><img src="<?php echo $icono[0]["Logo"]; ?>" style="width:20px; height:20px">
                                                  <?php 
                                                  echo $resultado1[$ii]["Especialidad"] ;
                                                 
                                                  ?>
                                          
                                                 </td>

                                                 <td>
                                           
                                                <input name="check_diadesde[]" class="form-control line vld draw" type="date" style="width:180px;" value=<?php echo $resultado1[$ii]["Fecha_Comienzo"]; ?>>

                                                  </td>

                                               <td>
                                           
                                                <input name="check_horadesde[]"  style="width:140px;" class="form-control line vld draw" type="time" value=<?php echo $resultado1[$ii]["horacomienzo"]; ?>>

                                               </td>

                                                  <td>
                                           
                                                 <input name="check_diafin[]" style="width:180px;"class="form-control line vld draw" type="date"  value=<?php echo $resultado1[$ii]["Fecha_Fin"]; ?>>

                                                  </td>

                                                   <td>
                                           
                                                <input name="check_horafin[]" style="width:140px;"class="form-control line vld draw" type="time"  value=<?php echo $resultado1[$ii]["horafin"];?>>

                                                  </td>

                                                
                                              <td>
                                               
                                                <select name="estadopersonal[]" class="form-control line vld draw" >
                                                <option  value="<?php  echo $resultado1[$ii]["Estado_Personal"]."-".$cont; ?>"><?php echo $resultado1[$ii]["estadopersonal"]; ?> </option> 

                                                 <?php
                                                 $tra=new trabajo();
                                                 $estpersonal=$tra->traigo_estado_tarea("TODAS");
                                                 for($p=0; $p<sizeof($estpersonal); $p++){
                                                   ?>
                                                   <option value="<?php echo $estpersonal[$p]["Id_EstadoTareas"]."-".$cont; ?>"><?php echo $estpersonal[$p]["Descripcion"]; ?> </option> 
                                                    <?php 
                                                    }
                                                    ?>                        
                                                </select>
                                              </td>


                                               <td>
                                               
                                                <select name="estadosupervisor[]" class="form-control line vld draw" >
                                                <option  value="<?php  echo $resultado1[$ii]["Estado_Supervisor"]."-".$cont; ?>"><?php echo $resultado1[$ii]["estadosupervisor"]; ?> </option> 


                                                 <?php
                                                 $tra=new trabajo();
                                                 $estpersonal=$tra->traigo_estado_tarea("TODAS");
                                                 for($p1=0; $p1<sizeof($estpersonal); $p1++){
                                                   ?>
                                                   <option value="<?php echo $estpersonal[$p1]["Id_EstadoTareas"]."-".$cont; ?>"><?php echo $estpersonal[$p1]["Descripcion"]; ?> </option> 
                                                    <?php 
                                                    }
                                                    ?>                        
                                                </select>
                                              </td>

                                             <th scope="row"><input type="checkbox" name="check_baja[]" value=<?php  echo $resultado1[$ii]["Id_Personal_Tarea"]."-".$cont; ?> >&nbsp;&nbsp;<img src=Draw/baja.png style=" width:25px; height:25px"></th>
                                             



                                                 
                                                </tr>
                                              <?php 
                                               $cont=$cont +1;
                                               }
                                               ?>

                                              
                                              <?php 
                                              // TRAIGO EL PERSONAL ACTIVO EN ESE MOMENTO
                                              
                                               $tra=new trabajo();
                                               $resto=$tra->traigo_personal_restante($percargado, $hoy,$hora_actual);
                                               $cont1=0;
 
                                               for($iii=0; $iii<sizeof($resto); $iii++){
                                               ?>
                                               <tr> 
                                                  <td><img src=Draw/Personal.png style=" width:20px; height:20px"></td>

                                                   <th scope="row"><input type="checkbox" name="check_personal_restante[]" value=<?php  echo $resto[$iii]["Id_Personal"]."-".$cont1; ?>></th>
                                                  <th scope="row"><?php  echo $resto[$iii]["Id_Personal"] ?> </th>
                                                  <td>
                                               <?php 
                                                  echo $resto[$iii]["NombreApellido"] ;
                                               ?> 
                                                 </td>
                                                  <?php 
                                                  $tra=new trabajo();
                                                  $icono=$tra->traigo_especialidad($resto[$iii]["Especialidad"]); ?> 
                                                  <td><img src="<?php echo $icono[0]["Logo"]; ?>" style="width:20px; height:20px">
                                                
                                                  <?php 
                                                  echo $resto[$iii]["Especialidad"] ;
                                                 
                                                  ?>
                                          
                                                 </td>

                                                 <td>
                                           
                                                <input name="check_diadesde1[]" class="form-control line vld draw" type="date" value="<?php echo date('Y-m-d');?>" style="width:180px;">

                                                  </td>

                                                    <td>
                                           
                                                <input name="check_horadesde1[]"  style="width:140px;" class="form-control line vld draw" type="time">

                                                  </td>

                                                  <td>
                                           
                                                 <input name="check_diafin1[]" style="width:180px;"class="form-control line vld draw" type="date" value="<?php echo date('Y-m-d');?>">    </td>

                                                   <td>
                                           
                                                <input name="check_horafin1[]" style="width:140px;"class="form-control line vld draw" type="time" >

                                                  </td>

                                                
                                              <td>
                                               
                                                <select name="estadopersonal1[]" class="form-control line vld draw" >
                                                <?php
                                                 $tra=new trabajo();
                                                 $estpersonal=$tra->traigo_estado_tarea("TODAS");
                                                 for($p=0; $p<sizeof($estpersonal); $p++){
                                                   ?>
                                                   <option value="<?php echo $estpersonal[$p]["Id_EstadoTareas"]."-".$cont1; ?>"><?php echo $estpersonal[$p]["Descripcion"]; ?> </option> 
                                                    <?php 
                                                    }
                                                    ?>                        
                                                </select>
                                              </td>


                                               <td>
                                               
                                                <select name="estadosupervisor1[]" class="form-control line vld draw" >
                                               
                                                 <?php
                                                 $tra=new trabajo();
                                                 $estpersonal=$tra->traigo_estado_tarea("TODAS");
                                                 for($p=0; $p<sizeof($estpersonal); $p++){
                                                   ?>
                                                   <option value="<?php echo $estpersonal[$p]["Id_EstadoTareas"]."-".$cont1; ?>"><?php echo $estpersonal[$p]["Descripcion"]; ?> </option> 
                                                    <?php 
                                                    }
                                                    ?>                        
                                                </select>
                                              </td>


                                                



                                                 
                                                </tr>
                                              <?php 
                                               $cont1=$cont1 +1;
                                               }

                                               ?>


                                            </tbody>


                              </table>
                      </div> 
   </div>

</div>


                        

 



     <hr />

  <div style="margin-left:10px;" class="row">
      <div class="col">
         <label  style="margin-left:35px; display:block; font-weight: bold;" class="control-label">Descripción de la Tarea</label>
         <textarea   name="destarea" rows="5" cols="55" > <?php echo ltrim($resultado[$i]["Descripcion_Tarea"]);?> </textarea>
      </div>


      <div class="col">
         <label  style="margin-left:20px; display:block; font-weight: bold;" class="control-label">Descripción de Materiales</label>
         <textarea  name="desmateriales" rows="5" cols="55"  > <?php echo ltrim($resultado[$i]["Descripcion_Materiales"]);?></textarea>
      </div>

      <div class="col">
                  <label  style="font-weight: bold;" class="control-label" >Estado</label>
                            <select name="estadotarea" style="width:350px;margin-left:15px;" class="form-control line vld draw" margin-left:180px;>
                             <?php 
                             $tra=new trabajo();
                             $estadotarea=$tra->traigo_estado_tarea_total($resultado[$i]["Estado_Tarea"]);
                             for($w=0; $w<sizeof($estadotarea); $w++){

                               ?>
                               <option value="<?php echo $estadotarea[$w]["Id_EstadoTareas"]; ?>"><?php echo $estadotarea[$w]["Descripcion"]; ?> </option> 
                                <?php 
                                }
                                $tra=new trabajo();
                                $estadotarea=$tra->traigo_estado_tarea_total("TODAS");
                                for($w=0; $w<sizeof($estadotarea); $w++){

                                ?>
                                <option value="<?php echo $estadotarea[$w]["Id_EstadoTareas"]; ?>"><?php echo $estadotarea[$w]["Descripcion"]; ?> </option> 
                                 <?php 
                                 }
                                 ?>                        
                               </select>
                  
       </div>



</div>


<?php 
  }
?>


 <hr />

  

<div class="row">


<div class="col" style="width:50%; text-align:left">    

  <a style="color:#4B0082; font-weight: bold; font-size:18px; margin-left:30px;" class="nav-link"  data-toggle="modal" data-target="#modal1"><img src=Draw/agregar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Modificar Tarea
   </a>

</div>



 <div class="col" style="width:50%; text-align: right">   
 
              <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="tareas.php?id_tarea=<?php echo $idtarea; ?>& id_supervisor=<?php echo trim($idsupervisor); ?> & filtro=<?php echo $filtro; ?>"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
              <span class="oi oi-trash" aria-hidden="true"></span>Volver al Menú
 </div>   
 
 </div> 


  <div class="form-group col-md-4">
  </div>
           
       

          <div class="modal fade" id=modal1>
            <div class="modal-dialog">
              <div class="modal-content">
                <div  class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                  <h5 class="modal-title">Modificacion y Edicion de Tareas Area de Mantenimiento</h5>
                </div> 

               <div class="modal-body">
                  Esta seguro que desea modificar esta tarea ?
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                   <input type="submit" class="btn btn-danger" value="Modificar Tarea" data-toggle="modal" data-target="#modal1"/>
                  
 
                </div>
            


              </div>
            </div>
          </div>


               

      


          
         

        </form>
     
    </div>

</header>
</html>
