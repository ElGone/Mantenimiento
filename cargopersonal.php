<?php
require("principal.php");
require_once("class/class.php");

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}

?>



<header>


<div style="width: 50%; background-color: white; margin-bottom:100px; margin-top:100px; margin-left:500px; border: DarkSlateGray 5px double">
        <br /><br />

        <h2 style="margin-left:30px; font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;"><img src=Draw/personal1.png style=" width:50px; height:50px">Carga del Personal - Sector Mantenimiento</h2>
        <hr />


        <form  method="post" action="ingresopersonal.php">
            <div class="row">
                <div class="col">

                  <label class="control-label" style="margin-left:42%; font-weight: bold;">Nombre y Apellido</label>
                  <input name="nomape" class="form-control line vld draw" style="width:300px; margin-left:35%; text-align: center" />
                 
                </div>
             </div>

              <br />
                    

             <div class="row">
                <div class="col">

                 <label for="Especializacion" class="control-label" style="margin-left:43.5%; font-weight: bold;">Especializacion</label>
                 <select name="especialidad" style="width:200px;margin-left:39.5%;" class="form-control line vld draw" margin-left:180px;>
                     <?php 
                     $tra=new trabajo();
                     $especialidad=$tra->traigo_especialidad("TODAS");
                     for($w=0; $w<sizeof($especialidad); $w++){
                     ?>
                      <option value=<?php echo $especialidad[$w]["Descripcion"]; ?>><?php echo $especialidad[$w]["Descripcion"]; ?></option> 
                     <?php 
                     }
                    ?>
                    </select>
                  

                 </div>
            </div>
             <br/>
                 
          
           

            <hr />



<div class="row">


 <div class="col">    

  <a style="color:#4B0082; font-weight: bold; font-size:18px; margin-left:5px;" class="nav-link" href="cargopersonal.php" data-toggle="modal" data-target="#modal1"><img src=Draw/agregar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Nuevo Personal
   </a>
                 
 
  </div>
<div class="col">  </div>
<div class="col">  </div>




 <div class="col">  
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
                  <h5 class="modal-title">Carga de Personal de Mantenimiento</h5>
                </div> 

               <div class="modal-body">
                  Esta seguro que desea dar de alta este nuevo personal ?
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