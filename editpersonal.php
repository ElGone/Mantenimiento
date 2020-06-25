<?php
require("principal.php");
require_once("class/class.php");

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}


$idpersonal=$_GET['idpersonal'];

?>



<header>


<div style="width: 50%; background-color: white; margin-bottom:100px; margin-top:100px; margin-left:500px; border:DarkSlateGray 5px double">
        <br /><br />

        <h2 style="margin-left:30px; font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;"><img src=Draw/personal1.png style=" width:50px; height:50px">Edicion y Modificacion del Personal - Sector Mantenimiento</h2>
        <hr />


        <form  method="post" action="modificopersonal.php?idpersonal=<?php echo $idpersonal;?>">

          <?php
          $tra=new trabajo();
          $resultado=$tra->traigo_personal("1", $idpersonal);
          error_reporting(E_ALL ^ E_NOTICE);
          for($i=0; $i<sizeof($resultado); $i++){

            ?>
               <div class="row">
                <div class="col">

                  <label class="control-label" style="margin-left:42%; font-weight: bold;">Nombre y Apellido</label>
                  <input value="<?php echo $resultado[$i]["NombreApellido"]; ?>" name="nomape" class="form-control line vld draw" style="width:300px; margin-left:35%; text-align: center" />
                 
                </div>
             </div>

              <br />
                    

             <div class="row">
                <div class="col">

                 <label for="Especializacion" class="control-label" style="margin-left:43.5%; font-weight: bold;">Especializacion</label>
                 <select name="especialidad" style="width:300px;margin-left:35%;text-align-last: center" class="form-control line vld draw">
                     <?php 
                     $tra=new trabajo();
                     $especialidad=$tra->traigo_especialidad($resultado[$i]["Especialidad"]);
                     for($w=0; $w<sizeof($especialidad); $w++){
                     ?>
                      <option value='<?php echo trim($especialidad[$w]["Descripcion"]); ?>'><?php echo  trim($especialidad[$w]["Descripcion"]); ?></option> 
                     <?php 
                     }
                     $especialidad1=$tra->traigo_especialidad("TODAS");
                     for($w1=0; $w1<sizeof($especialidad1); $w1++){
                     ?>
                      <option value='<?php echo trim($especialidad1[$w1]["Descripcion"]); ?>'><?php echo  trim($especialidad1[$w1]["Descripcion"]); ?></option> 
                     <?php 
                     }
                    ?>
                    </select>
                  

                 </div>
            </div>
                  <?php 
                     }
                    ?>

             <br/>
                 
                     

            <hr />



<div class="row">


 <div class="col" style="width:50%; text-align:left">    

  <a style="color:#4B0082; font-weight: bold; font-size:18px; margin-left:5px;" class="nav-link" href="cargotarea.php" data-toggle="modal" data-target="#modal1"><img src=Draw/agregar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Modificar Personal
   </a>
          
 
  </div>






 <div class="col" style="width:50%; text-align:right">  
            <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
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
                  <h5 class="modal-title">Modificacion y Edicion del Personal de Mantenimiento</h5>
                </div> 

               <div class="modal-body">
                  Esta seguro que desea efectuar los cambios ?
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                   <input type="submit" class="btn btn-danger" value="Modificar Personal" data-toggle="modal" data-target="#modal1"/>
                  
 
                </div>
            


              </div>
            </div>
          </div>
    
         

        </form>
     
    </div>

</header>
</html>