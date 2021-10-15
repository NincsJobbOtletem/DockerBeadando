<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Hexer{
  protected $username;   
  protected $password;
    
  function __construct($username,$password){  
    $this->username = $username;
    $this->password = $password;
  }


  function backseparate(){
    $row = $this->username."*".$this->password;
    return $row;
  }

  function spliter($row){
    $row = str_split($row);
    return $row;
  }
  function todec($row){
    foreach($row as $key =>$value){
      $row[$key] = ord($value);
    }
    return $row;
  }
  function convert($row,$shiftnums){
    $shiftnums = [5,-14,31,-9,3];
    for($i=0; $i<count($row);$i++){                       
    $row[$i]=$row[$i]+$shiftnums[$i%5];
    }
    return $row;
  }
  function dectohex($row){
    foreach($row as $key => $value){
      $row[$key] = dechex($value);
      }
    return $row; 
        }

  function hextobin($row){
    $row = hex2bin($row);
    return $row;
  }
  function binjoiner($row){
    $row = join($row);
    return $row;
  }


// $test = new Hexer("kalmaf@gmail.cam","kicsike");
// $row = $test->backseparate();
// $row = $test->spliter($row);
// $row = $test->todec($row);
// $row = $test->convert($row);
// $row = $test->dectohex($row);
// $row = $test->hexjoiner($row);

public function run($shiftnums){

$row = $this->backseparate();
$row = $this->spliter($row);
$row = $this->todec($row);
$row = $this->convert($row,$shiftnums);
$row = $this->dectohex($row);
$row = $this->binjoiner($row);
$row = $this->hextobin($row);


return $row;
}

}



?>