
<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phppractice";

$name = null;
$pass = null;


	// connection extablish
		try {
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    echo "Connected successfully" . "<br>"; 
		    }
		catch(PDOException $e)
		    {
		    echo "Connection failed: " . $e->getMessage();
		    }



	if(isset($_POST["login"]))
	{	//echo "Login Horaha hai" . "</br>";;
		$name = $_POST["loginName"];
		$pass = $_POST["loginPass"];


		// login		

		// // Create connection
		// $connTimepass = new mysqli($servername, $username, $password, $dbname);
		// // Check connection
		// if ($connTimepass->connect_error) {
		//     die("Connection failed: " . $connTimepass->connect_error);
		// } 

		// $isLogin = false;

		// $sql = "SELECT name, pass FROM users";
		// $result = $connTimepass->query($sql);

		// if ($result->num_rows > 0) {
		//     // output data of each row
		//     while($row = $result->fetch_assoc()) {
		//         //echo "name: " . $row["name"]. " - pass: " . $row["pass"]. "<br>";

		//         if($row["name"] == $name && $row["pass"] == $pass)
		//         {
		//         	echo "login successful";
		//         	$isLogin = true;
		//         	break;
		//         }		        
		//     }
		//     if($isLogin != true)
		//     {
		//         	echo "name or pass is incorrect";
		//     }
		// } else {
		//     echo "0 results";
		// }
		// $connTimepass->close();


$isLoggedIn = false;

try {
    $stmt = $conn->prepare("SELECT name, pass FROM users"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach($stmt->fetchAll() as $k=>$v) { 
        //echo $v["name"] . " " . $v["pass"];

    	if ($v["name"] == $name && $v["pass"] == $pass)
    	{
    		$isLoggedIn = true;
    	}
    }
    
    if($isLoggedIn == true) {
    	echo "Login Successful";
    }
    else if ($isLoggedIn == false)
    {
    	echo "Name or Password is incorrect";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


	}
	else if(isset($_POST["register"]))
	{
		//echo "Register Horaha hai" . "</br>";
		$name = $_POST["regName"];
		$pass = $_POST["regPass"];	



	// registration process				
		try {
		    $sql = "INSERT INTO users (name, pass)
		    VALUES ('" .$name. "' , '" .$pass. "')";
		    // use exec() because no results are returned
		    $conn->exec($sql);
		    echo "New record created successfully";
		    }
		catch(PDOException $e)
		    {
		    echo $sql . "<br>" . $e->getMessage();
		    }

	
	}

	// if($name != null) 
	// 	echo $name . " " . $pass;


//data query





// close the connection
$conn = null;

 ?>
