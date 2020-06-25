<?php
require("principalsinvertical.php");
require_once("class/class.php");

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}


$idpersonal=$_GET['idpersonal'];



?>



<header>

 

<div style="width: 100%; background-color: white; margin-top:60px; border: DarkSlateGray 5px double">
        <br />
        <?php 
        $tra=new trabajo();
        $personal=$tra->traigo_personal("1", $idpersonal);
        $titulo="Finalizar Trabajos Pendientes de ". $personal[0]["NombreApellido"]. " Especialidad ". $personal[0]["Especialidad"]; ?>
        
        <h2 style="margin-left:30px; font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;"><img src=Draw/tareas.png style=" width:50px; height:50px">&nbsp;&nbsp;<?php echo $titulo; ?> - Sector Mantenimiento</h2>


       
        <hr />
        <form  style="margin-left:3px;"method="post" action="cierrotrabajo.php?idpersonal=<?php echo $idpersonal; ?>">
        <div style="margin-left:10px;" class="row"> 
                              <div class="col" >
                                      <label style="margin-left:10px;" class="control-label" style="display:block"> <h4> Seleccione el Trabajo para su Finalizacion </h4></label>
                                 <div style="height: 600px;" class="scrollable">  
                                     <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col">Nº de Tarea</th>
                                                    <th scope="col">Nombre Tarea</th>
                                                    <th scope="col">Nº de Trabajo</th>
                                                    <th scope="col">Fecha Inicio</th>
                                                    <th scope="col">Hora Inicio</th>
                                                    <th scope="col">Fecha Final</th>
                                                    <th scope="col">Hora Final</th>
                                                    <th scope="col">Estado Personal</th>
                                                    <th scope="col">Estado Supervisor</th>
                                                    <th scope="col">Finalizar Tarea</th>
                                               
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                       
                                            <?php 
                                     
                                              
                                               
                                               $hoy=date("Y-m-d");
                                               $hora_actual = date("h:i:s");
                                               $tra=new trabajo();
                                               $resultado1=$tra->traigo_tareas_de_un_personal($idpersonal);
                                               $cont=0;

                                               for($ii=0; $ii<sizeof($resultado1); $ii++){
                                                
                                               ?>
                                               <tr> 
                                                  <td><img src=Draw/Personal.png style=" width:20px; height:20px"></td>

                                                  <th scope="row"><input type="checkbox" onchange="c(this)" onclick="c(this)" name="check_personal[]" value=<?php  echo $resultado1[$ii]["Id_Tarea"]."-".$resultado1[$ii]["Id_Personal_Tarea"]."-".$resultado1[$ii]["Orden"]."-".$cont; ?> checked  ></th>
                                                 
                                                 
                                                 <td> 
                                                 <?php echo $resultado1[$ii]["Id_Tarea"]; ?>
                                                 </td>

                                                 <td> 
                                    
                                                    <a style="color:#4B0082;"  class="nav-link" href="edittarea.php?idtarea=<?php echo $resultado1[$ii]["Id_Tarea"]; ?> & idsupervisor=<?php echo $resultado1[$ii]["Id_Supervisor"]; ?> & filtro=<?php echo $resultado1[$ii]["Estado_Tarea"]; ?>">
                                                      <span  class="oi oi-pencil" aria-hidden="true"></span><?php echo $resultado1[$ii]["Nombre_Tarea"]; ?>
                                                    </a>
                                                 

                                              
                                                 </td>


                                                 <td> 
                                                 <?php echo $resultado1[$ii]["Id_Personal_Tarea"]; ?>
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
                                               
                                                <select name="estadopersonal[]" class="form-control line vld draw" >
                                                <option  value="<?php  echo $resultado1[$ii]["Estado_Personal"]."-".$cont; ?>"><?php echo $resultado1[$ii]["estadopersonal"]; ?> </option> 

                                                 <?php
                                                 $tra=new trabajo();
                                                 $estpersonal=$tra->traigo_estado_tarea_total("3");
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
                                                 $estpersonal=$tra->traigo_estado_tarea_total("3");
                                                 for($p1=0; $p1<sizeof($estpersonal); $p1++){
                                                   ?>
                                                   <option value="<?php echo $estpersonal[$p1]["Id_EstadoTareas"]."-".$cont; ?>"><?php echo $estpersonal[$p1]["Descripcion"]; ?> </option> 
                                                    <?php 
                                                    }
                                                    ?>                        
                                                </select>
                                              </td>


                                              <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check_finalizo[]" value=<?php  echo $resultado1[$ii]["Id_Tarea"]."-".$cont; ?> >&nbsp;&nbsp;<img src=Draw/tareas.png style=" width:28px; height:28px"></th>
                                 



                                                 
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

  

 

<div class="row">


 <div class="col" style="width:50%; text-align:left">    

  <a style="color:#4B0082; font-weight: bold; font-size:18px; margin-left:30px;" class="nav-link"  data-toggle="modal" data-target="#modal1"><img src=Draw/agregar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Finalizar Trabajos
   </a>

  </div>




 <div class="col" style="width:50%; text-align:right"> 
              <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
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
                  <h5 class="modal-title">Finalización de Trabajos - Area de Mantenimiento</h5>
                </div> 

               <div class="modal-body">
                  Esta seguro que desea Finalizar este Trabajo ?
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
