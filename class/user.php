<?php

include_once 'class.php';


class User
{
   
   
    private $usuario=array();
     
       

    public function userExists($user, $pass)
    {
        $sql="SELECT * FROM usuarios WHERE Usuario='".$user."' AND Password='".$pass."'" ;
    
     
        $res= mysqli_query(conectar::con(), $sql);
        while($reg=mysqli_fetch_assoc($res))
        {
           $this->usuario[]=$reg;  
            
        }

        return $this->usuario;  
      
    } 


}

?>
