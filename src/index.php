<html>

<head>
    <title>Webfejlesztés beadandó Szabó Patrik</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>

<body>

<?php
include 'BexBack.php'; //includáljuk a BexBack.php-t
    
        function searchEmail($elemid, $array) {
            
            foreach ($array as $key => $value) {//0 index a felhasználónév 1 index a jelszó (a splited tömbben)
                if ($value[0] == $elemid) {
                    
                    return $value;
                }
            }
            return null;
         }
         function searchPassword($elemid, $array) {
            foreach ($array as $key => $value) {//0 index a felhasználónév 1 index a jelszó  (a splited tömbben)
                if ($value[1] == $elemid) {
                    return $value;
                }
            }
            return null;
         }
         



        if(isset($_GET["username"])&&isset($_GET["password"])){//GET el átadjuk a fn és a jelszót a változónak.
            $username=$_GET["username"];
            $password=$_GET["password"];        

            if($username=="" && $password=="" )
        {
            echo "<script type='text/javascript'> 
                alert('Kötelező megadni a felhasználónevet és a jelszót!'); 
            </script>";
        }
        else{//Amenyiben helyes a jelszó beolvassuk a file-t
 
            $file = fopen("password.txt", "r") or                           
                exit("Unable to open file!");
                while(! feof($file)) {
                $codedpw[] =fgets($file);
                    }
                array_pop($codedpw);
                
                fclose($file);
                
        // példányosítjuk és igy lesz egy hexback objektumunk.
        $test = new HexBack($codedpw); //és megkapja $codedpw-t
      
        $splited =$test->run([5,-14,31,-9,3]);  // megadjuk a run metódusnak a eltolás mértékeit és átadjuk az értéket a $splited változónak
        // echo "<pre>";
        // var_dump($splited);
        // echo "</pre>";
        if(searchEmail($username, $splited)!=null){
            
            if(searchPassword($password,$splited)!=null){
                
                error_reporting(E_ALL);
                $dbName="adatok";
                $dbUser="root";
                $dbPass="mypassword";

                $conn = new mysqli("db", $dbUser,$dbPass,$dbName);
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                $sql="select Titkos from adatok where username='$username'";
                $result=$conn->query($sql);
                

                while($colorresult=mysqli_fetch_row($result)){
                 
                switch ($colorresult[0]){   //Megkapott szin után beállítjuk a hátteret
                    case "piros":
                        echo "<body style='background-color:red'>";
                        break;
                    case "zold":
                        echo "<body style='background-color:green'>";
                        break;
                    case "sarga":
                        echo "<body style='background-color:yellow'>";
                        break;
                    case "kek":
                        echo "<body style='background-color:blue'>";
                        break;
                    case "fekete":
                        echo "<body style='background-color:black'>";
                            break;
                    case "feher":
                        echo "<body style='background-color:white'>";
                        break;
                    }
                }
                    }else {
                        echo "<script type='text/javascript'> 
                        alert('hibás jelszó!'); 
                    </script>";
                    header( "refresh:3;url=http://www.police.hu/" );
                    
            }
        }else {echo "<script type='text/javascript'> 
            alert('nincs ilyen felhasználó!'); 
        </script>";

            
        }
        }
    }

    ?>  
    <h2>Please Log in</h2>
        <div class="loginform">
            
		<form  action="index.php" method="GET">
                <label>
                <b>Username:
                </label>
                </b> 
				<input type="text" name="username" placeholder="Enter the User Name"/>	
                <br></br> 
                <label><b>Password:     
                </b>    
                </label>
                <input type="password" name="password" placeholder="Enter the Password"/>
                <br></br> 
			    <input type="submit" type="submit" value="LOGIN" id="submit"/>
                

		</form>
        <form action="reg.php" >
            <input  type="submit" value="Signup" id="submit"/>
        </form>
        </div>
            

   
</body>

</html>
