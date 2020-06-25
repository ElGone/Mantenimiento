
<?php
include("LoginCabezera.html");
$mensaje="";

$get = (isset($_GET['mensaje']) && !empty($_GET['mensaje']));
if ($get) {
	$mensaje=$_GET['mensaje'];
} 
session_start();
session_destroy();



?>

<body>


<div id='container1'>
  <div class='signup'>
     <form action="comprueba_login.php" method="POST" autocomplete="off" >

      <label style="font-size:34px;">Ingreso al Sistema</label>
      <br /> <br />
       <input name="username" type='text' placeholder='Usuario:' />
       <input name="password" type='password' placeholder='Password:'  />
       <br /> <br /><br />
     
       <input type='submit' value='INGRESAR'/>
       <br /> <br /> <br />
     </form>
  </div>

  <div class='whysign'>
        <br />
        <div class="row">
          <div class="col" style="width: 100%; text-align:center;">
              <img src=Draw/RiverPequeño.png style="width:100px; height:100px;">
          </div>
        </div>
        <div class="row">
          <div class="col" style="width: 100%; text-align:center;">
          <label style="font-size:30px; font-weight: bold; color: white;">Bienvenido</label>
          </div>
        </div>
        <br /> <br /> 
        <div class="row">
          <div class="col" style="width: 100%; text-align:center;">
          <label style="font-size:29px; color: white;">Sistema de Mantenimiento</label>
          </div>
        </div>
        <div class="row">
          <div class="col" style="width: 100%; text-align:center;">
          <label style="font-size:23px; color: white;">Club Atlético River Plate</label>
          </div>
        </div>
        <br /> <br /> <br /> <br /><br /><br />
        

  </div>

</div>
