<html>

<head>
    <title>Webfejlesztés</title>
    <link rel="stylesheet" type="text/css" href="regstyle.css"> 
</head>

<body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'Hexer.php'; 


    if(isset($_GET["username"])&&isset($_GET["color"])&&isset($_GET["password"])){

        $username=$_GET["username"];
        $password=$_GET["password"];
        $color=$_GET["color"];   
        
        if($username=="" && $color=="" && $password=="" ){
            echo "<script type='text/javascript'> 
            alert('kérlek adj meg valamit'); 
        </script>";

        }else{
            
                $dbName="adatok";
                $dbUser="root";
                $dbPass="mypassword";

                $conn = new mysqli("db", $dbUser,$dbPass,$dbName);
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                $sql="INSERT INTO adatok (Username, Titkos)
                VALUES ('$username', '$color')";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                  } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
            
                  $test = new Hexer($username,$password); //és megkapja $codedpw-t
                  $hexed =$test->run([5,-14,31,-9,3]);
                  
                  $filename = "password.txt";
                  file_put_contents($filename, $hexed. "\n",FILE_APPEND);
                  echo "<script type='text/javascript'> 
                        alert('sikeres regisztráció!'); 
                    </script>";
                  

            }
    }

?>  
    <h2>Sign Up</h2>
        <div class="loginform">
            
		<form  action="reg.php" method="GET">
                <label>
                <b>Username:
                </label>
                </b> 
				<input type="text" name="username" placeholder="Enter the User Name"/>	
                <br></br> 
                <label><b>FavColor:     
                </b>
                <input type="text" name="color" placeholder="Enter your favorit color"/>	
                <br></br> 
                <label><b>Password:     
                </b>

                </label>
                <input type="password" name="password" placeholder="Enter the Password"/>
                <br></br> 
			    <input type="submit" type="submit" value="Sign Up" id="submit"/>
                <br></br>

		</form>
        <form action="index.php" >
            <input type="submit" value="Back to login page" id="submit"/>
        </form>
       
        </div>
            

   
</body>

</html>