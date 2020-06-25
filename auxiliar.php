<form class="form-inline" method="post" action="buscotareas.php">
     
    
         <label style="font-size:20px;">Buscar Tarea por..</label>
  

   

        
        <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="opcionbusquedatareanumero" value="tarea">
              <label style="font-weight: bold;">N Tarea</label>&nbsp;          
              <input name="ntarea" value="1" type="number" min="1" class="form-control" style="width:90px;"  placeholder="Numero de Tarea">
        </div> 
         


        
        <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="opcionbusquedatarenombre" value="nombre">
                    <label style="font-weight: bold;">Tarea</label>&nbsp;          
                    <input name="nomtarea" type="text" class="form-control" style="width:250px;" placeholder="Nombre de la Tarea">
        </div>
          

        
          <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="opcionbusquedafecha"value="Fechas"> 
                  <label style="font-weight: bold;">Desde</label>&nbsp; 
                  <input name="fechadesde" class="form-control" type="date" style="width:170px;" value="<?php echo date("Y-m-d");?>">&nbsp;
                  <label style="font-weight: bold;">Hasta</label>&nbsp; 
                  <input name="fechahasta" class="form-control" type="date" style="width:170px;" value="<?php echo date("Y-m-d");?>">&nbsp;
          </div>
        
    

    
            <button type="submit" name="valor" value="Guardar">
		        <img src=Draw/buscar.png style=" width:30px; height:30px;"> Buscar
            </button>

   
 

  
  
</form>
