<?php
require_once("class/class.php");
require("principal.php");

if (!isset($_SESSION['usuario'])) {
	header("Location:index.php");}
 else {
 
	 $usuario=$_SESSION['usuario'];
 }


$estadopersonal=$_POST['estadopersonal'];
$estadosupervisor=$_POST['estadosupervisor'];
$idpersonal=$_GET['idpersonal'];




try {

    $post = (isset($_POST['check_personal']) && !empty($_POST['check_personal']));
    if ($post ) {
        $personal=$_POST['check_personal'];

    $contador = count($personal);

    if ($contador > 0) {
     
    for ($i = 0; $i < $contador; $i++) {
     
     $mipersonal=explode('-', $personal[$i]);
     $tarea=$mipersonal[0];
     $trabajo=$mipersonal[1];
     $orden=$mipersonal[2];
     $miestadopersonal=explode('-', $estadopersonal[$i]);
     $elestadopersonal=$miestadopersonal[0];
     $miestadosupervisor=explode('-', $estadosupervisor[$i]);
     $elestadosupervisor=$miestadosupervisor[0];
        
     

        $tra=new trabajo();
        $misdatos1=$tra->finalizotrabajos($tarea,$trabajo,$orden,$elestadopersonal, $elestadosupervisor, $usuario);




if ($misdatos1==1) {

	?>
        <br> <br> <br> <br>
		<div class="modal-dialog" style="margin-top: 50px;">
		    <div class="modal-content">
		        <div class ="modal-header">
                      <?php $titulo="La Tarea Nº ".  $tarea . " Con Trabajo Nº ". $trabajo. " Ha sido Finalizada por el Trabajador";?>
			              <h2 class="modal-title"> <?php echo  $titulo ?> </h2>
			              
                          </br>
					  
			    </div>         
			               

			     <div class ="modal-header">

			     	<a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
			    </div>    
			        
	        </div>
	    </div>
   <?php

	

	}

 else if ($misdatos1==2) { ?>
        <br> <br> <br> <br>
        <div class="modal-dialog" style="margin-top: 50px;">
		    <div class="modal-content">
		        <div class ="modal-header">
                <?php $titulo="La Tarea Nº ".  $tarea . " Con Trabajo Nº ". $trabajo. " ha sido Finalizada por el Trabajador y por el Supervisor";?>
			              <h2 class="modal-title"><?php echo  $titulo ?></h2>
			           
			        
                          </br>
					  
			    </div>         
			               

			     <div class ="modal-header">

			     	<a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
			    </div>    
			        
	        </div>
	    </div>
	    <?php
}

else if ($misdatos1==3) { ?>
    <br> <br> <br> <br>
    <div class="modal-dialog" style="margin-top: 50px;">
        <div class="modal-content">
            <div class ="modal-header">
            <?php $titulo="La Tarea Nº ".  $tarea . " Con Trabajo Nº ". $trabajo. " ha sido Finalizada por el Supervisor solomante. Se da por Finalizado el Trabajo";?>
                      <h2 class="modal-title"><?php echo  $titulo ?></h2>
                   
                
                      </br>
                  
            </div>         
                       

             <div class ="modal-header">

                 <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
            </div>    
                
        </div>
    </div>
    <?php
}

else if ($misdatos1==4) { ?>
    <br> <br> <br> <br>
    <div class="modal-dialog" style="margin-top: 50px;">
        <div class="modal-content">
            <div class ="modal-header">
            <?php $titulo="Tarea Nº ".  $tarea . " cuenta con Trabajos Pendientes sin Finalizar. No se realizaron los cambios";?>
                      <h2 class="modal-title"><?php echo  $titulo ?></h2>
                   
                
                      </br>
                  
            </div>         
                       

             <div class ="modal-header">

                 <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
            </div>    
                
        </div>
    </div>
    <?php
}

} 
    } else { ?>
        <br> <br> <br> <br>
        <div class="modal-dialog" style="margin-top: 50px;">
        <div class="modal-content">
            <div class ="modal-header">
            <?php $titulo="No se selecciono ningun Trabajo para ser modificado";?>
                      <h2 class="modal-title"><?php echo  $titulo ?></h2>
                   
                
                      </br>
                  
            </div>         
                       

             <div class ="modal-header">

                 <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
            </div>    
                
        </div>
    </div>

    <?php






    }

} else { ?>
    <br> <br> <br> <br>
    <div class="modal-dialog" style="margin-top: 50px;">
    <div class="modal-content">
        <div class ="modal-header">
        <?php $titulo="No se selecciono ningun Trabajo para ser modificado";?>
                  <h2 class="modal-title"><?php echo  $titulo ?></h2>
               
            
                  </br>
              
        </div>         
                   

         <div class ="modal-header">

             <a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="personal.php"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
        </div>    
            
    </div>
</div>

<?php






}





}
    
catch (Exception $e) {
    // estado 3 error en la ejecucion
        
    echo $e->getMessage();
                 
}

?>
