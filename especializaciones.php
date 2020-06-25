<?php
require("principal.php");
require_once("class/class.php");

if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}

?>

<header>
<div style="width: 100%; background-color: white; margin-top:60px; border: DarkSlateGray 5px double">

<div class="row">
  <div class="col"  style="width:40%;text-align:left">    
       
   <a style="border:0; color:#4B0082; font-weight: bold; font-size:20px;" class="nav-link" href="#"><img src=Draw/agregar.png style=" width:30px; height:30px;">
    <span class="oi oi-trash" aria-hidden="true"></span>Nuevo Especializacion
   </a>

  </div>
        
        
      
   <div class="col" style="width: 20%;text-align:center;"> 
   <label style="font-size:40px; text-align: center;font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;" class="control-label"><img src=Draw/especializaciones.png style=" width:50px; height:50px">&nbsp;&nbsp;Lista de Especializaciones</label>
   </div>
       
        
 
    

 
   <div class="col" style="width: 40%; text-align:right;">  
       <a style="border:0; color:#4B0082; font-weight: bold; font-size:20px;" class="nav-link"  href="principal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;">
       <span class="oi oi-trash" aria-hidden="true"></span>Volver al Menu
       </a>
  </div>   
</div>



  <hr />


  
<div style="height: 800px;" class="scrollable">  
     <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Especializacion Numero</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Edicion</th>
                    

                </tr>
            </thead>
            <tbody>

                        <?php 
                            
                         $tra=new trabajo();
                         $resultado=$tra->traigo_especialidad("TODAS");
                      
                         for($i=0; $i<sizeof($resultado); $i++){
                         ?>
                            <tr> 
                            <td><img src="<?php echo $resultado[$i]["Logo"]; ?>" style="width:50px; height:50px"></td>
                            <th scope="row"><?php  echo $resultado[$i]["Id_Especializaciones"] ?> </th>
                            <td>
                         <?php 
                            echo $resultado[$i]["Descripcion"] ;
                         ?> 
                           </td>
                          
                          
                       
                          <td>
                            <a style="color:#4B0082;" class="nav-link" href="#">
                                <span class="oi oi-pencil" aria-hidden="true"><img src=Draw/editar.png style=" width:30px; height:30px"></span>&nbsp;&nbsp; Editar
                            </a>
                            <a style="color:#4B0082;" class="nav-link" href="#">
                                <span class="oi oi-trash" aria-hidden="true"><img src=Draw/baja.png style=" width:30px; height:30px"></span>&nbsp;&nbsp; Dar de Baja
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