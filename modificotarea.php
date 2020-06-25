<?php
require_once("class/class.php");
require("principal.php");

if (!isset($_SESSION['usuario'])) {
	header("Location:index.php");}
 else {
 
	 $usuario=$_SESSION['usuario'];
 }

$supervisor=$_POST['supervisor'];
$nomtarea=$_POST['nomtarea'];
$tareadiacomienzo=$_POST['tareadiacomienzo'];
$tareadiafin=$_POST['tareadiafin'];
$personal=$_POST['check_personal'];
$diadesde=$_POST['check_diadesde'];
$horadesde=$_POST['check_horadesde'];
$diafin=$_POST['check_diafin'];
$horafin=$_POST['check_horafin'];
$estadopersonal=$_POST['estadopersonal'];
$estadosupervisor=$_POST['estadosupervisor'];
$diadesde1=$_POST['check_diadesde1'];
$horadesde1=$_POST['check_horadesde1'];
$diafin1=$_POST['check_diafin1'];
$horafin1=$_POST['check_horafin1'];
$estadopersonal1=$_POST['estadopersonal1'];
$estadosupervisor1=$_POST['estadosupervisor1'];
$destarea=$_POST['destarea'];
$desmateriales=$_POST['desmateriales'];
$estado_tarea=$_POST['estadotarea'];
$id_tarea=$_GET['id_tarea'];
$id_supervisor=$_GET['id_supervisor'];
$filtro=$_GET['filtro'];




$post = (isset($_POST['check_personal_restante']) && !empty($_POST['check_personal_restante']));
if ($post ) {
	$personalrestante=$_POST['check_personal_restante'];
} else {
	$personalrestante=0;

}


try {


$tra=new trabajo();
$post = (isset($_POST['check_baja']) && !empty($_POST['check_baja']));
if ($post ) {
  $bajas=$_POST['check_baja'];
  $misdatos1=$tra->modifico_personal_tarea_con_bajas($personal,$diadesde,$horadesde,$diafin,$horafin, $estadopersonal, $estadosupervisor, $id_tarea,$personalrestante, $diadesde1,$horadesde1,$diafin1,$horafin1,$estadopersonal1,$estadosupervisor1,$bajas,$id_supervisor,$filtro );
} else {
 $misdatos1=$tra->modifico_personal_tarea($personal,$diadesde,$horadesde,$diafin,$horafin, $estadopersonal, $estadosupervisor, $id_tarea,$personalrestante, $diadesde1,$horadesde1,$diafin1,$horafin1,$estadopersonal1,$estadosupervisor1,$id_supervisor,$filtro) ;
}



if ($misdatos1==1) {

$tra=new trabajo();
$misdatos=$tra->modifico_tarea($nomtarea,$tareadiacomienzo,$tareadiafin, $destarea,$desmateriales,$estado_tarea,$id_tarea, $usuario);

if ($misdatos==1) {
	$tra=new trabajo();
	$misdatos=$tra->modifico_dependencias($id_tarea);
	
	?>

        <br> <br> <br> <br>
		<div class="modal-dialog" style="margin-top: 50px;">
		    <div class="modal-content">
		        <div class ="modal-header">
			          
			              <h2 class="modal-title">Tarea Modificada con Exito</h2>
			           
			        
                          </br>
					  
			    </div>         
			               

			     <div class ="modal-header">

			     	<a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="edittarea.php?idtarea=<?php echo $id_tarea; ?>& idsupervisor=<?php echo $id_supervisor; ?> & filtro=TODOS"><img src=Draw/cerrar.png style="width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
			    </div>    
			        
	        </div>
	    </div>
   <?php

	} else if ($misdatos==2) { ?>

        <br> <br> <br> <br>

		<div class="modal-dialog" style="margin-top: 50px;">
		    <div class="modal-content">
		        <div class ="modal-header">
			          
			              <h2 class="modal-title">La Tarea cuenta con trabajos sin finalizar. No se realizaron los cambios</h2>
			           
			        
                          </br>
					  
			    </div>         
			               

			     <div class ="modal-header">

			     	<a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="tareas.php?id_tarea=<?php echo $id_tarea; ?>& id_supervisor=<?php echo $id_supervisor; ?> & filtro=<?php echo $filtro; ?>"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
			    </div>    
			        
	        </div>
	    </div>
    	

		<?php


	} else if ($misdatos==3) {
        header("Location:edittarea.php");

	}

} else if ($misdatos1==2) { ?>

        <br> <br> <br> <br>
        <div class="modal-dialog" style="margin-top: 50px;">
		    <div class="modal-content">
		        <div class ="modal-header">
			          
			              <h2 class="modal-title">No es posible finalizar el trabajo. Hay Trabajos Pendientes con fechas anteriores. No se realizaron los cambios</h2>
			           
			        
                          </br>
					  
			    </div>         
			               

			     <div class ="modal-header">

			     	<a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="tareas.php?id_tarea=<?php echo $id_tarea; ?>& id_supervisor=<?php echo $idsupervisor; ?> & filtro=<?php echo $filtro; ?>"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
			    </div>    
			        
	        </div>
	    </div>
	    <?php

	} else if ($misdatos1==3) { ?>

      <br> <br> <br> <br>
        <div class="modal-dialog" style="margin-top: 50px;">
		    <div class="modal-content">
		        <div class ="modal-header">
			          
			              <h2 class="modal-title">Hay un Trabajo Anterior sin Finalizar. No se realizaron los cambios</h2>
			           
			        
                          </br>
					  
			    </div>         
			               

			     <div class ="modal-header">

			     	<a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="tareas.php?id_tarea=<?php echo $id_tarea; ?>& id_supervisor=<?php echo $id_supervisor; ?> & filtro=<?php echo $filtro; ?>"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
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
