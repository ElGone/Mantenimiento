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
$destarea=$_POST['destarea'];
$desmateriales=$_POST['desmateriales'];
$estado_tarea=$_POST['estado_tarea'];

try {



   $tra=new trabajo();
   $misdatos=$tra->cargo_tarea($supervisor,$nomtarea,$tareadiacomienzo,$tareadiafin,$personal,$diadesde,$horadesde,$diafin,$horafin,$destarea,$desmateriales,$estado_tarea,$usuario);


?>
            <br> <br> <br> <br>
	        <div class="modal-dialog" style="margin-top: 50px;">
				    <div class="modal-content">
				        <div class ="modal-header">
					          
					              <h2 class="modal-title">Tarea Cargada con Exito</h2>
					           
					        
		                          </br>
							  
					    </div>         
					               

					     <div class ="modal-header">

					     	<a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="tareas.php?id_tarea=TODAS & id_supervisor=<?php  echo $supervisor; ?> & filtro=TODOS"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
					    </div>    
					        
			        </div>
			    </div>
	<?php


}
    
catch (Exception $e) {
    // estado 3 error en la ejecucion
        
    echo $e->getMessage();
                 
}
?>