<?php
require("principalsinvertical.php");
require_once("class/class.php");

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}


$idtarea=$_GET['idtarea'];
date_default_timezone_set('America/Argentina/Buenos_Aires');

?>



<header>

<script type="text/javascript">
    function c(a)
    {
        a.checked='checked';
    }
</script> 

<div style="width: 100%; background-color: white; margin-bottom:70px; margin-top:60px;border: DarkSlateGray 5px double">
        <br />

        <h2 style="margin-left:80px; font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;">Pedido de Ayudantes - Sector Mantenimiento</h2>


        <hr />

        <form  method="post" action="ingresoayudantes.php">
     <div style="margin-left:10px;" class="row"> 
      <div class="col" >
        <label style="margin-left:10px;" class="control-label" style="display:block">Personal Asignado a esta Tarea</label>
         <div style="height: 550px;" class="scrollable">  
          <table class="table">
           <thead class="thead-dark">
           <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col">Trabajador Nº</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Especialidad</th>
                      <th scope="col">Trabajo Nº</th>
                      <th scope="col">Fecha Inicio</th>
                      <th scope="col">Hora Inicio</th>
                      <th scope="col">Fecha Final</th>
                      <th scope="col">Hora Final</th>
                      <th scope="col">Pedido de Ayudantes</th>
                 
                  </tr>
              </thead>
              <tbody>

              <?php 
       
                    
                 $tra=new trabajo();
                 $resultado1=$tra->traigo_pedido_personal_ayudantes($idtarea);
                 $cont=0;

                 for($ii=0; $ii<sizeof($resultado1); $ii++){
                  $percargado[$ii]=$resultado1[$ii]["Id_Personal"]."-".$cont;
                 ?>
                 <tr> 
                    <td><img src=Draw/Personal.png style=" width:20px; height:20px"></td>

                    <th scope="row"><input type="checkbox"  onchange="c(this)" onclick="c(this)" checked="checked" name="check_personal_tarea[]" value=<?php  echo $resultado1[$ii]["Id_Tarea"]."-".$resultado1[$ii]["Id_Pedido_Ayudante"]."-".$cont; ?>></th>
                    <th scope="row"><?php  echo $resultado1[$ii]["Id_Personal"] ?> </th>

                    <td>
                     <?php 
                        echo $resultado1[$ii]["nompersonal"] ;
                     ?> 
                   </td>


                   <td>
                    <?php 
                    echo $resultado1[$ii]["Especialidad"] ;
                   
                    ?>
                   </td>


                   <td>
                    <?php 
                    echo $resultado1[$ii]["Id_Trabajo"] ;
                   
                    ?>
                   </td>




                   <td>
                     <?php 
                    echo $resultado1[$ii]["Fecha_Comienzo"]; 
                     ?>
                    </td>

                   <td>
                     <?php 
                    echo $resultado1[$ii]["horacomienzo"]; 
                     ?>
                    </td>

                    <td>
                     <?php 
                    echo $resultado1[$ii]["Fecha_Fin"];
                     ?>
                    </td>
             
                  <td>
                     <?php 
                    echo $resultado1[$ii]["horafin"];
                     ?>
                    </td>

                  
                <td>
                 <textarea  name="check_ayudantes[]" rows="3" cols="45" wrap="soft"><?php echo $resultado1[$ii]["Ayudantes"]; ?></textarea>

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


  

<div class="row">


 <div class="col" style="width:50%; text-align:left">     

  <a style="color:#4B0082; font-weight: bold; font-size:18px; margin-left:5px;" class="nav-link" href="pedidoayudantes.php" data-toggle="modal" data-target="#modal1"><img src=Draw/agregar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Ingresar Ayudantes
   </a>
                 
 
  </div>




 <div class="col" style="width:50%; text-align:right"> 
            <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="tareas.php?id_tarea=<?php echo $idtarea; ?> & id_supervisor=TODOS & filtro=TODOS"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
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
                  <h5 class="modal-title">Carga de Ayudantes para el Area de Mantenimiento</h5>
                </div> 

               <div class="modal-body">
                  Esta seguro que desea dar de alta este pedido ?
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