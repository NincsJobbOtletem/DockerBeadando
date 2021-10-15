<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class HexBack{
  protected $coded;   //hexBack tulajdonságai
    
  function __construct($coded){  //construktor declarácciója ez mindig autómatikusan megfog hívódni
    $this->coded = $coded;
  }

  protected function bintohex($row){ //egy új metódus 
    $row = bin2hex($row);   //binárisbol hexába alakitás
    
    $row = str_split($row,2);         //tördelés 2esre
    $remove =array_pop($row);       //itt elveszük az utolsó karaktert a $rowbol a \n miatt
    
    return ($row);
    
  }

   protected function hextodec($row){       //hexröl decre alakitás
    foreach($row as $key => $value){
        $row[$key] = hexdec($value);
  }
      return $row; 
  }
  protected function convert($shiftnums,$row){           //átconvertálás (inkább shiftelés) ez megkap egy tömböt és a $row-t
    for($i=0; $i<count($row);$i++){                       //végig megy a $row számsoron és a sor[i] elemeiböl kivonja a siftelés értékét[5,-14,31,-9,3] 
      $increased_decimal[$i]=$row[$i]-$shiftnums[$i%5]; //ami a tömböl 5 el való osztása utáni maradékadik elem lesz.
    }
    return $increased_decimal;
  }
  protected function backtochar($row){      //itt alakítja vissza karakterré
    foreach($row as $key => $value){   
      
      $row[$key] = chr($value);
      
    }
    return $row;
  
  }
  protected function chartojoin($row){   //összefüzzük a külön álló betüket egy szöveggé
    
    $row = join($row);
    return $row; 
  }
  protected function separatepw($row){   //itt * mentén ketté bontjuk a tömböt fn és jelszóra

    $row = explode("*",$row);
    return $row;
  }
 
  public function run($shiftnums){ //run metódus megkapja [shifterszámokat] és futatja a matódusokat

      foreach($this->coded as $row){  //végigmegy a $this-codeden $row val tehát soronként.
       $row = $this->bintohex($row);
       
       $row = $this->hextodec($row);
      
       $row = $this->convert($shiftnums,$row);
      
       $row = $this->backtochar($row);
       
       $row = $this->chartojoin($row);
      
       $row = $this->separatepw($row); 
        
        $splited[] = $row;                 
      
       
        }
        return $splited;
        
        
        

      
        
    }

   
  
}


?>