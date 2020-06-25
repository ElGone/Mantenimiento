<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

class conectar
{

   
   public static function con()
   {
       $host="localhost";
       $user="root";
       $pass="";
       $db="mantenimiento";
       
       
       
        //$coneccion=mysql_connect('localhost', 'stagingahba' , 'aahpagina2015');
           $coneccion=mysqli_connect($host, $user , $pass, $db);
           mysqli_select_db($coneccion, $db);
           return $coneccion;

         
   }
   
  
}


class trabajo
{
   
   
    private $usuario=array();
    private $tipo_combo=array();
    private $personal=array();
    private $personalactivo=array();
    private $especialidad=array();
    private $supervisor=array();
    private $estadotareas=array();
    private $ultimatarea=array();
    private $tareas=array();
    private $personaltarea=array();
    private $ultima_personal_tarea=array();
    private $verifico_dependencias=array();
    private $dependencia=array();
    private $orden=array();
    private $trabajo=array();
    



  
  public function traigo_personal($opcion, $personal)
  {
        
     if ($opcion==1){
        if ($personal=="TODOS")   {
          $sql="SELECT * FROM personal WHERE Estado=1 ORDER BY Especialidad" ;
          
          } else {

          $sql="SELECT * FROM personal WHERE Id_Personal=".$personal." AND Estado=1 ORDER BY Especialidad";
          
        }

      } else if ($opcion==2) {
    
      $sql="SELECT * FROM personal WHERE NombreApellido LIKE '%". $personal."%' AND Estado=1 ORDER BY Especialidad" ;
    
    }



     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
         $this->personal[]=$reg;  
          
       }

       return $this->personal;  
           
  }


  public function traigo_personal_activo($personal,$hoy,$hora)

  {


       $tra=new trabajo();
       $resultado=$tra->traigo_personal("1", $personal);
             
      for($i=0; $i < sizeof($resultado); $i++) {
     
        $mipersonal=$resultado[$i]["Id_Personal"];
                 

        $sql1="SELECT * FROM personal_tarea WHERE Id_Personal=".$mipersonal. " AND ((Fecha_Fin < '".$hoy."' AND Estado_Supervisor <> 3) OR (Fecha_Fin ='".$hoy."' AND Hora_Fin >= '".$hora."' AND Estado_Supervisor <> 3) OR (Fecha_Fin >'".$hoy."' AND Estado_Supervisor <> 3))";
            
       // echo $sql1;
          if ($resultado1=mysqli_query(conectar::con(), $sql1)){ 
              $row_cnt = mysqli_num_rows($resultado1);
              if ($row_cnt==0){
                 

                 $sql="SELECT * FROM personal WHERE Id_Personal=".$mipersonal." AND Estado=1" ;
                 $res= mysqli_query(conectar::con(), $sql);
                 while($reg=mysqli_fetch_assoc($res))
                  {
                   $this->personalactivo[]=$reg;  
                  }
              } 
          } 
      }

 

       return $this->personalactivo; 
         
  }


  public function traigo_personal_activo1($personal,$hoy,$hora)

  {


       $tra=new trabajo();
       $resultado=$tra->traigo_personal("1", $personal);
             
      for($i=0; $i < sizeof($resultado); $i++) {
     
        $mipersonal=$resultado[$i]["Id_Personal"];
                 

        $sql1="SELECT a.Id_Personal_Tarea, a.Id_Tarea, a.Id_Personal, a.Fecha_Comienzo, a.Hora_Comienzo, a.Fecha_Fin, a.Hora_Fin, a.Estado_Supervisor, a.Estado_Personal, b.Especialidad FROM personal_tarea AS a INNER JOIN presonal AS b ON a.Id_Personal=b.Id_Personal WHERE a.Id_Personal=".$mipersonal. " AND ((a.Fecha_Fin < '".$hoy."' AND a.Estado_Supervisor <> 3) OR (a.Fecha_Fin ='".$hoy."' AND a.Hora_Fin >= '".$hora."' AND a.Estado_Supervisor <> 3) OR (a.Fecha_Fin >'".$hoy."' AND a.Estado_Supervisor <> 3)) ORDER BY b.Especialidad";
            
       // echo $sql1;
          if ($resultado1=mysqli_query(conectar::con(), $sql1)){ 
              $row_cnt = mysqli_num_rows($resultado1);
              if ($row_cnt==0){
                 

                 $sql="SELECT * FROM personal WHERE Id_Personal=".$mipersonal." AND Estado=1" ;
                 $res= mysqli_query(conectar::con(), $sql);
                 while($reg=mysqli_fetch_assoc($res))
                  {
                   $this->personalactivo[]=$reg;  
                  }
              } 
          } 
      }

 

       return $this->personalactivo; 
         
  }




public function traigo_personal_restante($personalnorestante,$hoy,$hora)
{
 
   $contador=0;

   if(!empty($personalnorestante)) {  
      $contador = count($personalnorestante);
   }

       $tra=new trabajo();
       $resultado=$tra->traigo_personal("1", "TODOS");
             
      for($i=0; $i < sizeof($resultado); $i++) {
     
        $mipersonal=$resultado[$i]["Id_Personal"];

        $sql1="SELECT * FROM personal_tarea WHERE Id_Personal=".$mipersonal. " AND ((Fecha_Fin < '".$hoy."' AND Estado_Supervisor <> 3)OR (Fecha_Fin ='".$hoy."' AND Hora_Fin >= '".$hora."' AND Estado_Supervisor <> 3) OR (Fecha_Fin >'".$hoy."' AND Estado_Supervisor <> 3))";

          if ($resultado1=mysqli_query(conectar::con(), $sql1)){ 
              $row_cnt = mysqli_num_rows($resultado1);
              if ($row_cnt==0){
                 

                 $sql="SELECT * FROM personal WHERE Id_Personal=".$mipersonal." AND Estado=1" ;
                 $res= mysqli_query(conectar::con(), $sql);


                 while($reg=mysqli_fetch_assoc($res))
                  {
                      $cargo=1;
                      if ($contador > 0) {
                      for($ii=0; $ii < $contador; $ii++) {
                           $personalnorestante=explode('-', $personalnorestante[$ii]);
                           $elpersonalnorestante=$personalnorestante[0];
                           If ($mipersonal==$elpersonalnorestante){
                               $cargo=2;
                            } 
                      }
                    }

                      if ($cargo==1){
                         $this->personal[]=$reg;  
                      }
                  }
              } 
          } 
      }


       return $this->personal; 


}



public function traigo_supervisores($supervisor)
{
        
     
     if ($supervisor=="TODOS")   {
       $sql="SELECT * FROM supervisores WHERE Estado=1";
     } else {
       $sql="SELECT * FROM supervisores WHERE Id_Supervisor=".$supervisor." AND Estado=1" ;

     }                               


     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->supervisor[]=$reg;  
            
       }
        return $this->supervisor;  
 
          
}  


    public function traigo_especialidad($especialidad)
    {
        
     
     if ($especialidad=="TODAS")   {
       $sql="SELECT * FROM especializaciones";
     } else {
       $sql="SELECT * FROM especializaciones WHERE Descripcion='".$especialidad."'" ;

     }


     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->especialidad[]=$reg;  
            
       }
        return $this->especialidad;  
 
          
    }  

     public function traigo_tareas($tarea, $supervisor, $filtro)
    {
       
     if (trim($tarea)=="TODAS" && trim($supervisor)=="TODOS")  {
       $sql="SELECT * FROM tareas";
       $op=1;
     } else if (trim($supervisor)=="TODOS" && trim($tarea) !== "TODAS") {
       $sql="SELECT * FROM tareas WHERE Id_Tarea=".$tarea;
        $op=2;
     } else if (trim($supervisor) !=="TODOS" && trim($tarea) !=="TODAS" ) {       
      $sql="SELECT * FROM tareas WHERE Id_Supervisor=".$supervisor. " AND Id_Tarea=".$tarea;
       $op=3;
     } else if (trim($supervisor) !== "TODOS" && trim($tarea) == "TODAS") {
       $sql="SELECT * FROM tareas WHERE Id_Supervisor=".$supervisor;
        $op=4;
     }

   
 
     if (trim($filtro) !== "TODOS") {
        if ($op==1){
          $sql=$sql." WHERE Estado_Tarea=".$filtro. " ORDER BY Estado_Tarea, Fecha_Comienzo DESC";
        } else {
           $sql=$sql." AND Estado_Tarea=".$filtro. " ORDER BY Estado_Tarea, Fecha_Comienzo DESC";
        }

     } else {
      $sql=$sql." ORDER BY Estado_Tarea, Fecha_Comienzo DESC";

     }

   
     
        

     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->tareas[]=$reg;  
            
       }
        return $this->tareas;  
 
          
    }  


    public function traigo_tareas_con_personal($id_personal)
    {
       
    
       $sql="SELECT b.Id_Tarea, b.Nombre_Tarea, b.Id_Supervisor, b.Fecha_Comienzo, b.Fecha_Fin, b.Estado_Tarea, c.NombreApellido FROM personal_tarea As a INNER JOIN tareas AS b ON a.Id_Tarea=b.Id_Tarea INNER JOIN supervisores AS c ON b.Id_Supervisor=c.Id_Supervisor INNER JOIN estado_tareas AS d ON b.Estado_Tarea=d.Id_EstadoTareas WHERE a.Id_Personal=".$id_personal. " GROUP BY b.Id_Tarea ORDER BY b.Estado_Tarea, b.Fecha_Comienzo";
         
        

     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->tareas[]=$reg;  
            
       }
        return $this->tareas;  
 
          
    }  




    public function busco_tarea($opcion, $valor1, $valor2,$filtro)
    {

      try {

        

    if (trim($filtro) !== "TODOS") {
       
     if ($opcion=="1")  {
       $sql="SELECT * FROM tareas WHERE Id_Tarea=".$valor1." AND Estado_Tarea=".$filtro;
      
     } else if ($opcion=="2") {
       $sql="SELECT * FROM tareas WHERE Nombre_Tarea LIKE '%". $valor1."%' AND Estado_Tarea=".$filtro. " ORDER BY Fecha_Comienzo";
      
     }  else if ($opcion=="3") {      
      $sql="SELECT * FROM tareas WHERE Fecha_Comienzo BETWEEN '". $valor1."'  AND '". $valor2."' AND Estado_Tarea=".$filtro. " ORDER BY Fecha_Comienzo";
      
     } 
     
    } else {

      if ($opcion=="1")  {
        $sql="SELECT * FROM tareas WHERE Id_Tarea=".$valor1;
       
      } else if ($opcion=="2") {
        $sql="SELECT * FROM tareas WHERE Nombre_Tarea LIKE '%". $valor1."%'  ORDER BY Fecha_Comienzo";
       
      }  else if ($opcion=="3") {      
       $sql="SELECT * FROM tareas WHERE Fecha_Comienzo BETWEEN '". $valor1."'  AND '". $valor2."' ORDER BY Fecha_Comienzo";

     }    
       
    }
    
 
   

     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->tareas[]=$reg;  
            
       }
        return $this->tareas;  



      }  catch (Exception $e) {
        echo $e->getMessage();
             
          
    }  
  }



    public function traigo_personal_tarea($pertar)
    {
        
     
     if ($pertar=="TODOS")   {
      
     } else {
        $sql="SELECT a.Id_Personal, a.Fecha_Comienzo, a.Fecha_Fin , TIME_FORMAT(a.Hora_Comienzo, '%H:%i') as horacomienzo, TIME_FORMAT(a.Hora_Fin,'%H:%i') as horafin, b.NombreApellido, (c.Descripcion) as estadopersonal ,(d.Descripcion) as estadosupervisor, b.Especialidad, a.Estado_Personal, a.Estado_Supervisor, a.Id_Personal_Tarea FROM personal_tarea AS a INNER JOIN personal AS b ON a.Id_Personal=b.Id_Personal INNER JOIN estado_tareas AS c ON a.Estado_Personal = c.Id_EstadoTareas  INNER JOIN estado_tareas AS d ON a.Estado_Supervisor = d.Id_EstadoTareas  WHERE a.Id_Tarea=$pertar ORDER BY a.Fecha_Comienzo, a.Hora_Comienzo, a.Fecha_Fin, a.Hora_Fin ASC"; 

     }


     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->personaltarea[]=$reg;  
            
       }
        return $this->personaltarea;  
 
          
    }  




     public function cargo_personal($nomape, $especialidad, $estado)
    {

      
       $con="INSERT INTO personal(NombreApellido, Especialidad, Estado) VALUES ('$nomape','$especialidad', $estado)";
        $resultado=mysqli_query(conectar::con(), $con); 
        $dev="Se ha cargado un nuevo Integrante del Personal de Mantenimiento" ;
        
    
        return $dev;      
      
   }



   public function traigo_estado_tarea($estado_tareas)
    {
        
     
     if ($estado_tareas=="TODAS")   {
       $sql="SELECT * FROM estado_tareas WHERE Nivel <> 1";
     } else {

       $sql="SELECT * FROM estado_tareas WHERE Id_EstadoTareas=".$estado_tareas. " AND Nivel <> 1";

     }


     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->estadotareas[]=$reg;  
            
       }
        return $this->estadotareas;  
 
          
    }  


    public function traigo_estado_tarea_total($estado_tareas)
    {
        
     
     if ($estado_tareas=="TODAS")   {
       $sql="SELECT * FROM estado_tareas";
     } else {

       $sql="SELECT * FROM estado_tareas WHERE Id_EstadoTareas=".$estado_tareas;

     }


     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->estadotareas[]=$reg;  
            
       }
        return $this->estadotareas;  
 
          
    }  


    public function cargo_tarea($supervisor,$nomtarea,$tareadiacomienzo,$tareadiafin,$personal,$diadesde,$horadesde,$diafin,$horafin,$destarea,$desmateriales,$estado_tarea,$usuario)
    {

      $hoy=date("Y-m-d");
      //Cargo la Tarea

      $con="INSERT INTO tareas(Nombre_Tarea, Id_Supervisor, Fecha_Comienzo, Fecha_Fin, Descripcion_Materiales,Descripcion_Tarea,Estado_Tarea, Fecha, Usuario) VALUES ('$nomtarea',$supervisor, '$tareadiacomienzo','$tareadiafin','$desmateriales','$destarea',$estado_tarea,  '$hoy', '$usuario')";
      $resultado=mysqli_query(conectar::con(), $con); 


      // si hay cargados trabajos 

        $estado_personal=2;
        $estado_supervisor=2;
     
      if(!empty($personal)) {


           $contador = count($personal);
           // Cargo los Trabajos
     
          $tra=new trabajo();
          $resultado=$tra->ultima_tarea();
          $ultimatarea=$resultado[0]["id"];
            
          for ($i = 0; $i < $contador; $i++) {
            if ($i > 0){
              $estado_personal=1;
              $estado_supervisor=1;
            }  

          $mipersonal=explode('-', $personal[$i]);
          $elpersonal=$mipersonal[0];
          $posicion=$mipersonal[1];

          
            $con="INSERT INTO personal_tarea(Id_Tarea, Id_Personal, Fecha_Comienzo, Hora_Comienzo, Fecha_Fin, Hora_Fin, Estado_Personal, Estado_Supervisor) VALUES ( $ultimatarea  ,$elpersonal, '$diadesde[$posicion]','$horadesde[$posicion]','$diafin[$posicion]','$horafin[$posicion]',$estado_personal,$estado_supervisor)";
            $resultado=mysqli_query(conectar::con(), $con); 
                
          }

    

           // Cargo las dependencias de los trabajos y pedidos de ayudantes (en blanco)


            $tra=new trabajo();
            $resultado1=$tra->ultima_personal_tarea($ultimatarea);
              
              $pos=1;
              for($i=0; $i < sizeof($resultado1); $i++){

                if ($i==0){
                  $fecha_comienzo_ultimo="2000-01-01";
                  $hora_comienzo_ultimo="2000-01-01";
                  }

            
                  $trabajo=$resultado1[$i]["Id_Personal_Tarea"];
                  $estado_trabajo=$resultado1[$i]["Estado_Supervisor"];
                  $fecha_comienzo=$resultado1[$i]["Fecha_Comienzo"];
                  $hora_comienzo=$resultado1[$i]["Hora_Comienzo"];

                  if ($fecha_comienzo_ultimo==$fecha_comienzo && $hora_comienzo_ultimo==$hora_comienzo){
                    $pos=$pos-1; 
                  }

                  $con="INSERT INTO dependencias(Id_Tarea, Id_Trabajo, Orden, Estado_Trabajo) VALUES ( $ultimatarea ,$trabajo, $pos ,$estado_trabajo)";
                  $resultado=mysqli_query(conectar::con(), $con); 


                  $con="INSERT INTO pedidos_ayudantes(Id_Tarea, Id_Trabajo) VALUES ( $ultimatarea ,$trabajo)";
                  $resultado=mysqli_query(conectar::con(), $con);

                  $fecha_comienzo_ultimo=$resultado1[$i]["Fecha_Comienzo"];
                  $hora_comienzo_ultimo=$resultado1[$i]["Hora_Comienzo"];
                  $pos=$pos +1;
           
              }

      }

      $tra=new trabajo();
      $resultado2=$tra->traigo_personal_tarea_ordenado($ultimatarea);
            
      for($i=0; $i < sizeof($resultado2); $i++){
        if ($i==0){
          $con="UPDATE personal_tarea SET Estado_Personal=2,Estado_Supervisor=2 WHERE  Id_Personal_Tarea=".$resultado2[$i]["Id_Personal_Tarea"];
          $resultado=mysqli_query(conectar::con(), $con); 
        } else {
          $con="UPDATE personal_tarea SET Estado_Personal=1,Estado_Supervisor=1 WHERE Id_Personal_Tarea=".$resultado2[$i]["Id_Personal_Tarea"];
          $resultado=mysqli_query(conectar::con(), $con); 
        }

      }  


      $dev="Se ha cargado una nueva Tarea para el Area de Mantenimiento" ;
      return $dev;      
      
      
   }



   public function traigo_personal_tarea_ordenado($ultimatarea)
   {
   
   $sql="SELECT * FROM personal_tarea WHERE Id_Tarea=".$ultimatarea. " ORDER BY Fecha_Comienzo, Hora_Comienzo, Fecha_Fin, Hora_Fin" ;
   
   $res= mysqli_query(conectar::con(), $sql);
   while($reg=mysqli_fetch_assoc($res))
     {
       $this->personal[]=$reg;  
        
     }

     return $this->personal;  
   }


   public function modifico_tarea($nomtarea,$tareadiacomienzo,$tareadiafin, $destarea,$desmateriales,$estado_tarea,$tarea, $usuario)
  {
     
     $dev=1;
     $row_cnt = 0;
     

       try {


        if ($estado_tarea==3) {

            // verifico que no haya trabajos abiertos
          $sql="SELECT * FROM personal_tarea WHERE Id_Tarea=".$tarea." AND Estado_Supervisor <> 3";

          if ($resultado1=mysqli_query(conectar::con(), $sql)){ 
              $row_cnt = mysqli_num_rows($resultado1);}
        } 

        if ($row_cnt==0){

                 //Modifico Tarea
                   $con="UPDATE tareas SET Nombre_Tarea='". $nomtarea."', Fecha_Comienzo='".$tareadiacomienzo."', Fecha_Fin='".$tareadiafin."', Descripcion_Tarea='". $destarea."', Descripcion_Materiales='". $desmateriales."', Estado_Tarea=". $estado_tarea. " WHERE  Id_Tarea=".$tarea;
                   $resultado=mysqli_query(conectar::con(), $con); 
                   $fecha_actual = date("Y-m-d h:i:s");
                   
                 
                  
                    $con="INSERT INTO ultima_modificacion(Id_Tarea, Fecha, Usuario) VALUES ($tarea, '$fecha_actual', '$usuario')";
                    $resultado=mysqli_query(conectar::con(), $con); 

                   $dev=1; 
        } else {
          // estado 2 falta cerrar trabajos
          $dev=2; 
        }

          
  

    }
    
         catch (Exception $e) {
          // estado 3 error en la ejecucion
            $dev=3;
            echo $e->getMessage();
                 
        }


       return $dev;

       
      }






   public function modifico_personal_tarea($personal,$diadesde,$horadesde,$diafin,$horafin, $estadopersonal, $estadosupervisor, $tarea,$personalrestante, $diadesde1,$horadesde1,$diafin1,$horafin1,$estadopersonal1,$estadosupervisor1,$supervisor,$filtro)
    {

      $dev=1;
     

      try {
      $contador = count($personal);
     
      for ($i = 0; $i < $contador; $i++) {
       
       $mipersonal=explode('-', $personal[$i]);
       $elpersonal=$mipersonal[0];
       $posicion=$mipersonal[1];
       $miestadopersonal=explode('-', $estadopersonal[$i]);
       $elestadopersonal=$miestadopersonal[0];
       $miestadosupervisor=explode('-', $estadosupervisor[$i]);
       $elestadosupervisor=$miestadosupervisor[0];


        $con="UPDATE personal_tarea SET Fecha_Comienzo='". $diadesde[$posicion]."', Hora_Comienzo='". $horadesde[$posicion].":00.00000', Fecha_Fin='". $diafin[$posicion]."', Hora_Fin='".$horafin[$posicion].":00.00000', Estado_Personal=".$elestadopersonal.", Estado_Supervisor=".$elestadosupervisor. " WHERE Id_Tarea=".$tarea." AND Id_Personal=".$elpersonal;
        
        
        $resultado=mysqli_query(conectar::con(), $con); 
      }
        
      // verifico si hay nuevos trabajos
     
        if(!empty($personalrestante)) {
            $contador = count($personalrestante);     
            for ($i = 0; $i < $contador; $i++) {
             
             $mipersonal=explode('-', $personalrestante[$i]);
             $elpersonal=$mipersonal[0];
             $posicion=$mipersonal[1];
             $miestadopersonal=explode('-', $estadopersonal1[$i]);
             $elestadopersonal=$miestadopersonal[0];
             $miestadosupervisor=explode('-', $estadosupervisor1[$i]);
             $elestadosupervisor=$miestadosupervisor[0];
                 


              $con="INSERT INTO personal_tarea(Id_Tarea, Id_Personal, Fecha_Comienzo, Hora_Comienzo, Fecha_Fin, Hora_Fin, Estado_Personal, Estado_Supervisor) VALUES ( $tarea  ,$elpersonal, '$diadesde1[$posicion]','$horadesde1[$posicion]','$diafin1[$posicion]','$horafin1[$posicion]',$elestadopersonal,$elestadosupervisor)";
              
              $resultado=mysqli_query(conectar::con(), $con); 
            }
                   
      }

       // dependencias


       // $tra=new trabajo();
      //  $resultado=$tra->ultima_personal_tarea($tarea);
             
      //  for($i=0; $i < sizeof($resultado); $i++) {
     
     //          $trabajo=$resultado[$i]["Id_Personal_Tarea"];
    //           $estado_trabajo=$resultado[$i]["Estado_Supervisor"];
    //           $conta=$i+1;
            

      //         $sql="SELECT * FROM dependencias WHERE Id_Tarea=".$tarea." AND Id_Trabajo=".$trabajo;
              
     //          if ($resultado1=mysqli_query(conectar::con(), $sql)){ 
    //           $row_cnt = mysqli_num_rows($resultado1);
             

       //        if ($row_cnt==0){
      //            $con="INSERT INTO dependencias(Id_Tarea, Id_Trabajo, Orden, Estado_Trabajo) VALUES ( $tarea ,$trabajo, $conta,$estado_trabajo)";
     //              $resultado4=mysqli_query(conectar::con(), $con); 

      //         } else {

     //  //             for($ii=0; $ii < $row_cnt; $ii++){ 
      //              $con="UPDATE dependencias SET Orden=".$conta.", Estado_Trabajo=".$estado_trabajo." WHERE Id_Tarea=".$tarea." AND Id_Trabajo=".$trabajo;
     //                $resultado3=mysqli_query(conectar::con(), $con); 
      //             }

         //       }

         //   }
      
     

  


        } catch (Exception $e) {
            echo $e->getMessage();
            $dev=2;
     
                  
        }

        return $dev;


}



 public function modifico_personal_tarea_con_bajas($personal,$diadesde,$horadesde,$diafin,$horafin, $estadopersonal, $estadosupervisor, $tarea,$personalrestante, $diadesde1,$horadesde1,$diafin1,$horafin1,$estadopersonal1,$estadosupervisor1,$bajas,$supervisor,$filtro)
    {

    try {
      $contador = count($personal);
     
      for ($i = 0; $i < $contador; $i++) {

       
       $mipersonal=explode('-', $personal[$i]);
       $elpersonal=$mipersonal[0];
       $posicion=$mipersonal[1];
       $miestadopersonal=explode('-', $estadopersonal[$i]);
       $elestadopersonal=$miestadopersonal[0];
       $miestadosupervisor=explode('-', $estadosupervisor[$i]);
       $elestadosupervisor=$miestadosupervisor[0];
           
         
      
        $con="UPDATE personal_tarea SET Fecha_Comienzo='". $diadesde[$posicion]."', Hora_Comienzo='". $horadesde[$posicion].":00.00000', Fecha_Fin='". $diafin[$posicion]."', Hora_Fin='".$horafin[$posicion].":00.00000', Estado_Personal=".$elestadopersonal.", Estado_Supervisor=".$elestadosupervisor. " WHERE Id_Tarea=".$tarea." AND Id_Personal=".$elpersonal;
        
        
        $resultado=mysqli_query(conectar::con(), $con); 

      }
      // verifico si hay nuevos trabajos
     
        if(!empty($personalrestante)) {
            $contador = count($personalrestante);     
            for ($i = 0; $i < $contador; $i++) {
             
             $mipersonal=explode('-', $personalrestante[$i]);
             $elpersonal=$mipersonal[0];
             $posicion=$mipersonal[1];
             $miestadopersonal=explode('-', $estadopersonal1[$i]);
             $elestadopersonal=$miestadopersonal[0];
             $miestadosupervisor=explode('-', $estadosupervisor1[$i]);
             $elestadosupervisor=$miestadosupervisor[0];
                 


              $con="INSERT INTO personal_tarea(Id_Tarea, Id_Personal, Fecha_Comienzo, Hora_Comienzo, Fecha_Fin, Hora_Fin, Estado_Personal, Estado_Supervisor) VALUES ( $tarea  ,$elpersonal, '$diadesde1[$posicion]','$horadesde1[$posicion]','$diafin1[$posicion]','$horafin1[$posicion]',$elestadopersonal,$elestadosupervisor)";
              
              $resultado=mysqli_query(conectar::con(), $con); 
            }
                   
      }

    

     // doy de baja al trabajo marcado y la dependencia

        $contadorbajas = count($bajas);

        for ($i = 0; $i < $contadorbajas; $i++) {
           $mitrabajobaja=explode('-', $bajas[$i]);
           $eltrabajobaja=$mitrabajobaja[0];
           $con="DELETE FROM personal_tarea WHERE Id_Tarea=".$tarea." AND Id_Personal_Tarea=".$eltrabajobaja;
              
           $resultado=mysqli_query(conectar::con(), $con); 

           $con="DELETE FROM dependencias WHERE Id_Tarea=".$tarea." AND Id_Trabajo=". $eltrabajobaja;
              
           $resultado=mysqli_query(conectar::con(), $con); 

         }

          

        } catch (Exception $e) {
            echo $e->getMessage();
     
                  
        }
    

        


   }


public function traigo_orden($tarea,$personal)
{

     
    
      $dev=1;

        

       $tra=new trabajo();
       $trabajo=$tra->traigo_trabajo($tarea,$personal);
             
       for($ii=0; $ii < sizeof($trabajo); $ii++) {
     
              $mitrabajo=$trabajo[$ii]["Id_Personal_Tarea"];
              $estado_trabajo=$trabajo[$ii]["Estado_Supervisor"];
              $orden=$trabajo[$ii]["Orden"];

                          
            if ($orden <> 1) {
              $sql="SELECT * FROM dependencias WHERE Id_Tarea=".$tarea." AND Orden < ".$orden. " AND Estado_Trabajo <> 3";
              
              
              if ($resultado1=mysqli_query(conectar::con(), $sql)){ 
                  $row_cnt = mysqli_num_rows($resultado1);
                    if ($row_cnt > 0){
                      $dev=2;
                   }
              } else {
                      $dev=1;


              }
            }
      }

 

     return $dev;

          
}   


public function traigo_trabajo($tarea,$elpersonal)
{
        
     
    $sql="SELECT a.Id_Tarea, a.Id_Personal, a.Id_Personal_Tarea, b.Orden, a.Estado_Supervisor FROM personal_tarea AS a INNER JOIN dependencias AS b ON a.Id_Tarea = b.Id_Tarea AND a.Id_Personal_Tarea = b.Id_Trabajo WHERE a.Id_Tarea=$tarea AND a.Id_Personal=$elpersonal";


     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->trabajo[]=$reg;  
            
       }
        return $this->trabajo;  
 
          
}  



 public function verifico_dependencias($tarea,$orden)
    {
        
     
      $sql="SELECT Count(Id_Dependencias) AS depende FROM dependencias WHERE Id_Tarea=".$tarea." AND Orden < ".$orden. " AND Estado_Trabajo = 3" ;
     

        $res= mysqli_query(conectar::con(), $sql);
         while($reg=mysqli_fetch_assoc($res))
           {

           $this->verifico_dependencias[]=$reg;  


            
        }

         return $this->verifico_dependencias;  
 
 
          
    }   






    public function modifico_dependencias($tarea)

    {


       $tra=new trabajo();
       $resultado=$tra->ultima_personal_tarea($tarea);
             
       for($i=0; $i < sizeof($resultado); $i++) {
     
              $trabajo=$resultado[$i]["Id_Personal_Tarea"];
              $estado_trabajo=$resultado[$i]["Estado_Supervisor"];
              $conta=$i+1;
            

              $sql="SELECT * FROM dependencias WHERE Id_Tarea=".$tarea." AND Id_Trabajo=".$trabajo;
              
              if ($resultado1=mysqli_query(conectar::con(), $sql)){ 
              $row_cnt = mysqli_num_rows($resultado1);
             

              if ($row_cnt==0){
                 $con="INSERT INTO dependencias(Id_Tarea, Id_Trabajo, Orden, Estado_Trabajo) VALUES ( $tarea ,$trabajo, $conta,$estado_trabajo)";
                  $resultado4=mysqli_query(conectar::con(), $con); 

              } else {

                  for($ii=0; $ii < $row_cnt; $ii++){ 
                   $con="UPDATE dependencias SET Orden=".$conta.", Estado_Trabajo=".$estado_trabajo." WHERE Id_Tarea=".$tarea." AND Id_Trabajo=".$trabajo;
                    $resultado3=mysqli_query(conectar::con(), $con); 
                  }

               }

            }
      
      }
        
         
    }


    public function ultima_tarea()
    {
        
     
      $sql="SELECT MAX(Id_Tarea) AS id FROM tareas";
     
     
        $res= mysqli_query(conectar::con(), $sql);
        while($reg=mysqli_fetch_assoc($res))
        {
           $this->ultimatarea[]=$reg;  
            
        }

         return $this->ultimatarea;  
 
          
    }   


     public function ultima_personal_tarea($ultimatarea)
    {
        
     
    $sql="SELECT * FROM personal_tarea WHERE Id_Tarea=".$ultimatarea." ORDER BY Fecha_Comienzo, Hora_Comienzo ASC";

        $res= mysqli_query(conectar::con(), $sql);
         while($reg=mysqli_fetch_assoc($res))
           {

           $this->ultima_personal_tarea[]=$reg;  
            
        }

         return $this->ultima_personal_tarea;  
 
          
    }   




  public function traigo_pedido_personal_ayudantes($pertar)
    {           
    
      
    
        $sql="SELECT a.Id_Pedido_Ayudante,  a.Id_Trabajo, a.Id_Tarea, a.Ayudantes, b.Id_Personal, b.Fecha_Comienzo, b.Fecha_Fin , TIME_FORMAT(b.Hora_Comienzo, '%H:%i') as horacomienzo, TIME_FORMAT(b.Hora_Fin,'%H:%i') as horafin, (c.NombreApellido) as nompersonal, c.Especialidad FROM pedidos_ayudantes AS a INNER JOIN personal_tarea AS b ON a.Id_Trabajo=b.Id_Personal_Tarea INNER JOIN personal AS c ON b.Id_Personal = c.Id_Personal WHERE a.Id_Tarea=$pertar ORDER BY b.Fecha_Comienzo, b.Fecha_Fin ASC"; 

   


     $res= mysqli_query(conectar::con(), $sql);
     while($reg=mysqli_fetch_assoc($res))
       {
           $this->personaltarea[]=$reg;  
            
       }
        return $this->personaltarea;  
 
          
    }  

 public function modifico_ayudantes($personal_ayudante,$ayudantes)
 {


      $contador = count($personal_ayudante);


      for ($i = 0; $i < $contador; $i++) {
       
       $mitareatrabajo=explode('-', $personal_ayudante[$i]);
       $tarea=$mitareatrabajo[0];
       $trabajo=$mitareatrabajo[1];
       $posicion=$mitareatrabajo[2];

      $con="UPDATE pedidos_ayudantes SET Ayudantes='". $ayudantes[$posicion]."' WHERE  Id_Tarea=".$tarea. " AND Id_Pedido_Ayudante=".$trabajo;
      $resultado=mysqli_query(conectar::con(), $con); 

      }

}

 public function modifico_personal($idpersonal,$nomape,$especialidad)
 {

    
      $con="UPDATE personal SET NombreApellido='". $nomape."', Especialidad='".$especialidad."'  WHERE  Id_Personal=".$idpersonal;
      $resultado=mysqli_query(conectar::con(), $con); 

    

}


public function traigo_tareas_de_un_personal($idpersonal){

      $sql="SELECT a.Id_Tarea, a.Id_Personal, a.Fecha_Comienzo, a.Fecha_Fin , TIME_FORMAT(a.Hora_Comienzo, '%H:%i') as horacomienzo, TIME_FORMAT(a.Hora_Fin,'%H:%i') as horafin, b.NombreApellido, (c.Descripcion) as estadopersonal ,(d.Descripcion) as estadosupervisor, b.Especialidad, a.Estado_Personal, a.Estado_Supervisor, a.Id_Personal_Tarea, e.Nombre_Tarea, f.Orden, e.Id_Supervisor, e.Estado_Tarea FROM personal_tarea AS a INNER JOIN personal AS b ON a.Id_Personal=b.Id_Personal INNER JOIN estado_tareas AS c ON a.Estado_Personal = c.Id_EstadoTareas  INNER JOIN estado_tareas AS d ON a.Estado_Supervisor = d.Id_EstadoTareas INNER JOIN tareas AS e ON a.Id_Tarea=e.Id_Tarea INNER JOIN dependencias AS f ON a.Id_Personal_Tarea = f.Id_Trabajo  WHERE a.Id_Personal=$idpersonal AND a.Estado_Supervisor <> 3 ORDER BY a.Id_Tarea, a.Fecha_Comienzo, a.Hora_Comienzo ASC"; 



try {
  

  $res= mysqli_query(conectar::con(), $sql);
  while($reg=mysqli_fetch_assoc($res))
    {
        $this->personaltarea[]=$reg;  
         
    }
     return $this->personaltarea;  




    }  catch (Exception $e) {
       echo $e->getMessage();
            
   }


}

public function finalizotrabajos($tarea,$trabajo,$orden, $estadopersonal, $estadosupervisor, $usuario){

  $dev=1;

try { 

  $fecha_actual = date("Y-m-d h:i:s");
  $con="INSERT INTO ultima_modificacion(Id_Tarea, Fecha, Usuario) VALUES ($tarea, '$fecha_actual', '$usuario')";
  $resultado=mysqli_query(conectar::con(), $con); 


  // controlo que no haya un trabajo anterior sin finalizar
  $sigo=1;
  if ($orden !== 1) {
    $tra=new trabajo();
    $miorden=$orden-1;
    $sigo=$tra->verifico_numero_orden_sin_aprobacion($tarea,$miorden);
  }

  if ($sigo==1){
 

  if ($estadopersonal==3 && $estadosupervisor <> 3) {
      $con="UPDATE personal_tarea SET Estado_Personal=3 WHERE Id_Personal_Tarea=".$trabajo ;
      $resultado=mysqli_query(conectar::con(), $con);   $dev=1; }

      else if ($estadopersonal ==3 && $estadosupervisor == 3){

        $con="UPDATE personal_tarea SET Estado_Personal=3, Estado_Supervisor=3 WHERE Id_Personal_Tarea=".$trabajo;
        $resultado=mysqli_query(conectar::con(), $con); 

        $con="UPDATE dependencias SET Estado_Trabajo=3 WHERE Id_Tarea=".$tarea. " AND Id_Trabajo=".$trabajo;
        $resultado=mysqli_query(conectar::con(), $con);  

        // verifico que no haya otro numero de orden igual sin aprobacion del supervisor
        $tra=new trabajo();
        $resultado3=$tra->verifico_numero_orden_sin_aprobacion($tarea,$orden);
        if ($resultado3==1){

             $miorden=intval($orden) + 1;
             $tra=new trabajo();
             $resultado=$tra->cambio_estado_trabajos($tarea,$miorden);
             for($i=0; $i < sizeof($resultado); $i++) {
                  $con="UPDATE personal_tarea SET Estado_Personal=2 , Estado_Supervisor=2 WHERE Id_Personal_Tarea=".$resultado[$i]["Id_Trabajo"] ;
                  $resultado1=mysqli_query(conectar::con(), $con); 
                }
                    
              
      }
      $dev=2 ; 
    }
      
      

      else if ($estadopersonal <> 3 && $estadosupervisor = 3){

        $con="UPDATE personal_tarea SET Estado_Personal=3, Estado_Supervisor=3 WHERE Id_Personal_Tarea=".$trabajo;
        $resultado=mysqli_query(conectar::con(), $con); 
        // verifico que no haya otro numero de orden igual sin aprobacion del supervisor
        $tra=new trabajo();
        $resultado3=$tra->verifico_numero_orden_sin_aprobacion($tarea,$orden);
        if ($resultado3==1){

             $miorden=intval($orden) + 1;
             $tra=new trabajo();
             $resultado=$tra->cambio_estado_trabajos($tarea,$miorden);
             for($i=0; $i < sizeof($resultado); $i++) {
                  $con="UPDATE personal_tarea SET Estado_Personal=2 , Estado_Supervisor=2 WHERE Id_Personal_Tarea=".$resultado[$i]["Id_Trabajo"] ;
                  $resultado1=mysqli_query(conectar::con(), $con); 
                }
                    
              
      }


        $con="UPDATE dependencias SET Estado_Trabajo=3 WHERE Id_Tarea=".$tarea. " AND Id_Trabajo=".$trabajo;
        $resultado=mysqli_query(conectar::con(), $con);   $dev=3 ; 
      } 


    
} else {
  $dev=4;
}

 


}  catch (Exception $e) {
  echo $e->getMessage();
       
}

return $dev;


}




public function cambio_estado_trabajos($tarea,$miorden)
{


$sql="SELECT * FROM dependencias WHERE Id_Tarea=".$tarea." AND Orden =". $miorden ." AND  Estado_Trabajo <> 3" ;

try {
  

  $res= mysqli_query(conectar::con(), $sql);
  while($reg=mysqli_fetch_assoc($res))
    {
        $this->personaltarea[]=$reg;  
         
    }
     return $this->personaltarea;  




    }  catch (Exception $e) {
       echo $e->getMessage();
            
   }


}

public function verifico_numero_orden_sin_aprobacion($tarea,$miorden){


$opc=1;
$sql="SELECT * FROM dependencias WHERE Id_Tarea=".$tarea." AND Orden =". $miorden ." AND  Estado_Trabajo <> 3" ;

try {
  

  $res= mysqli_query(conectar::con(), $sql);
  while($reg=mysqli_fetch_assoc($res))
    {
        $opc=2; 
         
    }
   return $opc;  


  }  catch (Exception $e) {
       echo $e->getMessage();
            
    }


}




}


?>
