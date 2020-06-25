<?php
require_once("class/class.php");
require("principal.php");


if (!isset($_SESSION['usuario'])) {
   header("Location:index.php");}



$nomape=$_POST['nomape'];
$especialidad=$_POST['especialidad'];
$idpersonal=$_GET['idpersonal'];

try {


$tra=new trabajo();
$misdatos=$tra->modifico_personal($idpersonal,$nomape,$especialidad);
?>
        <br> <br> <br> <br>
		<div class="modal-dialog" style="margin-top: 50px;">
		    <div class="modal-content">
		        <div class ="modal-header">
			          
			              <h2 class="modal-title">Personal Modificado con Exito</h2>
			           
			        
                          </br>
					  
			    </div>         
			               

			     <div class ="modal-header">

			     	<a style="color:#4B0082; font-weight: bold; font-size:18px;" class="nav-link" href="javascript:history.back(-1);"><img src=Draw/cerrar.png style=" width:30px; height:30px;"><span class="oi oi-trash" aria-hidden="true"></span> &nbsp;&nbsp;Volver al Menu
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
