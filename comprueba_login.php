<?php
require_once("class/user.php");

$username=$_POST['username'];
$password=$_POST['password'];
$cont=0;


try {


$usu=new User();
$misdatos=$usu->userExists($username, $password);

   for($i=0; $i < sizeof($misdatos); $i++){
       $cont=1;
       session_start();
       $_SESSION["usuario"]=$_POST['username'];
       $_SESSION["nombreusuario"]=$misdatos[$i]["NombreApellido"];
       header("Location:principal.php");
   }

   if ($cont==0){
       $mensaje="Usuario o Password Incorrectos";
       header("Location:index.php?mensaje=$mensaje");

   }
	


}
    
catch (Exception $e) {
           
    echo $e->getMessage();
                 
}




?>
