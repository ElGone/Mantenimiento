<?php
require("principalsinvertical.php");
require_once("class/class.php");

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}

$idtarea=$_GET['idtarea'];
$idsupervisor=$_GET['idsupervisor'];
$filtro=$_GET['filtro'];

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
        
        <h2 style="margin-left:30px; font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;"><img src=Draw/tareas.png style=" width:50px; height:50px">&nbsp;&nbsp; Tarea Finalizada - Sector Mantenimiento</h2>


       
        <hr />

     
          <?php
          $mitarea=(string)$idtarea;
          $tra=new trabajo();
          $resultado=$tra->traigo_tareas($mitarea, "TODOS", $filtro);
                      
          for($i=0; $i<sizeof($resultado); $i++){
            ?>

              <div class="row">
                        <div class="col">

                         <label for="Supervisor" class="control-label" style="margin-left:50px;">Supervisor</label>
                            <select disabled="true" name="supervisor" id="supervisor" style="width:350px;margin-left:30px;" class="form-control line vld draw" margin-left:180px;>

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
                            <label class="control-label" style="margin-left:10px">Nombre de la Tarea</label>
                                <input value="<?php echo $resultado[$i]["Nombre_Tarea"]; ?>" name="nomtarea" class="form-control line vld draw" style="width:300px; margin-left:10px; text-align: center" readonly />
                          </div>

                         <div class="col">
                            <label style="margin-left:10px;" class="control-label" style="display:block">Fecha de Comienzo</label>
                            <input class="form-control line vld draw" type="date" name="tareadiacomienzo" style="margin:.4rem 0; width:200px; margin-left:10px;" value=<?php echo $resultado[$i]["Fecha_Comienzo"]; ?>>
                          </div>

                          <div class="col">
                            <label style="margin-left:10px;" class="control-label" style="display:block">Fecha de finalización</label>
                            <input class="form-control line vld draw" type="date" name="tareadiafin" style="margin:.4rem 0; width:200px; margin-left:10px;" value=<?php echo $resultado[$i]["Fecha_Fin"]; ?>>
                          </div>

                        </div>

           
               <hr />



              <div style="margin-left:10px;" class="row"> 
                              <div class="col" >
                                      <label style="margin-left:10px;" class="control-label" style="display:block">Selección de Personal y Trabajo</label>
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
                                               
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                       
                                            <?php 
                                     
                                               $percargado=array();
                                               $check_baja=array();
                                               $hoy=date("Y-m-d");
                                               $hora_actual = date("h:i:s");
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
                                           
                                                <input name="check_diadesde[]" class="form-control line vld draw" type="date" style="width:180px;" value=<?php echo $resultado1[$ii]["Fecha_Comienzo"]; ?> readonly>

                                                </td>

                                               <td>
                                           
                                                <input name="check_horadesde[]"  style="width:130px;" class="form-control line vld draw" type="time" value=<?php echo $resultado1[$ii]["horacomienzo"]; ?> readonly>

                                               </td>

                                                  <td>
                                           
                                                 <input name="check_diafin[]" style="width:180px;"class="form-control line vld draw" type="date"  value=<?php echo $resultado1[$ii]["Fecha_Fin"]; ?> readonly>

                                                  </td>

                                                   <td>
                                           
                                                <input name="check_horafin[]" style="width:130px;"class="form-control line vld draw" type="time"  value=<?php echo $resultado1[$ii]["horafin"];?> readonly>

                                                  </td>

                                                
                                              <td>
                                               
                                                <select disabled="true" name="estadopersonal[]" class="form-control line vld draw" >
                                                <option  value="<?php  echo $resultado1[$ii]["Estado_Personal"]."-".$cont; ?>"><?php echo $resultado1[$ii]["estadopersonal"]; ?> </option> 

                                                 
                                              </td>


                                              <td>
                                               
                                               <select disabled="true" name="estadosupervisor[]" class="form-control line vld draw" >
                                               <option  value="<?php  echo $resultado1[$ii]["Estado_Supervisor"]."-".$cont; ?>"><?php echo $resultado1[$ii]["estadosupervisor"]; ?> </option> 

                                               
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

  <div style="margin-left:10px;" class="row">
      <div class="col">
         <label  style="margin-left:35px;" class="control-label" >Descripcion de la Tarea</label>
         <textarea disabled  name="destarea" rows="5" cols="55" > <?php echo ltrim($resultado[$i]["Descripcion_Tarea"]);?> </textarea>
      </div>


      <div class="col">
         <label  style="margin-left:20px;" class="control-label" >Descripcion de Materiales</label>
         <textarea disabled name="desmateriales" rows="5" cols="55"  > <?php echo ltrim($resultado[$i]["Descripcion_Materiales"]);?> </textarea>
      </div>

      <div class="col">
                  <label  class="control-label" >Estado</label>
                            <select disabled="true" name="estadotarea" style="width:350px;margin-left:15px;" class="form-control line vld draw" margin-left:180px;>
                             <?php 
                             $tra=new trabajo();
                             $estadotarea=$tra->traigo_estado_tarea_total($resultado[$i]["Estado_Tarea"]);
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


     <div class="col">  
                  <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="tareas.php?id_tarea=TODAS & id_supervisor=TODOS  & filtro=TODOS"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
                  <span class="oi oi-trash" aria-hidden="true"></span>Volver al Menu
      </div>   
 
</div>


</div>


</header>
</html>
