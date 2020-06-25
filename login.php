<?php
include("cabezera.html");
$mensaje="";

$get = (isset($_GET['mensaje']) && !empty($_GET['mensaje']));
if ($get) {
	$mensaje=$_GET['mensaje'];
} 
session_start();
session_destroy();



?>

<body>



<header>



<div class="row" style="margin-top:70px;">
    <div class="col">
        <label class="control-label" style="margin-left:24.5%; font-weight:bold; font-family:Segoe UI; font-size:32pt; color:White">Sistema de Mantenimiento - Club Atletico River Plate</label>
    </div>
</div>



<div class="row">
    <div class="col">
         <img src=Draw/River.png style="display:block; margin-left:auto; margin-right:auto; width:110px; height:129px;">
    </div>
</div>



<div style="width: 25%; background-color: white; margin-top:70px; margin-left:770px; border:DarkSlateGray 5px double">
      <div class="row" style="margin-top:10px;">
          <div class="col">
              <label class="control-label" style="margin-left:5%; font-weight:bold; font-family:Segoe UI; font-size:18pt; color:DimGray">Ingrese su Usuario y Clave para Ingresar</label>
          </div>
      </div>
      <form action="comprueba_login.php" method="POST">

       
            <div class="row" style="margin-top:20px;">
                <div class="col">

                  <label class="control-label" style="margin-left:44%; font-weight: bold;">Usuario</label>
                  <input name="username" type="text" class="form-control line vld draw" style="width:300px; margin-left:20%; text-align: center" />
                 
                </div>
             </div>

             
                    

             <div class="row">
                <div class="col">

                <label class="control-label" style="margin-left:43%; font-weight: bold;">Password</label>
                <input name="password" type="password" class="form-control line vld draw" style="width:300px; margin-left:20%; text-align: center" />
                  

                 </div>
            </div>

            <br/>


            <div class="row">
                <div class="col">
                <label class="control-label" style="margin-left:15%; font-weight: bold; color:Crimson;font-size:18pt; "><?php echo $mensaje; ?></label>
                </div>
            </div>


             <br/>
             <hr />

             <div class="row">


                  <div class="col">    
                     <button type="submit" style="background-color: Transparent; border:none; font-weight: bold; font-size:18px; margin-left:5px;"><img src=Draw/ingresar.png style=" width:30px; height:30px;">Ingresar</button>
                  </div>


                  <div class="col">  </div>
                  <div class="col">  </div>
                  <div class="col">  </div>
                  <div class="col">  </div>




                 
             </div>
                 
          
           

           



  
         

        </form>
     
        </div>
</header>

</body>
</html>