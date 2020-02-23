<!DOCTYPE html>
<html>
	<body>
		<form method='get' action='blank.php'>
			<input type='text' name='email' />
			<input type='submit' value='Check' name='btn' />
		</form>
	</body>
</html>
<?php
	require_once 'db_server_info.php';
	
	if(isset($_GET['btn']) && isset($_GET['email'])){
		$email = $_GET['email'];
	
		//Create the connection
		$mysqli = new mysqli($hostname, $username, $password, $database);
		//Check connection
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$result = $mysqli->query("SELECT email FROM info_db WHERE email='$email'");
		
		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		if($row['email'] === $email){ echo 'Email already taken!'; }
		else{
			$result = $mysqli->query("INSERT INTO info_db VALUES('$email')");
			if($result === TRUE) echo "Email updated";
			else echo "Email NOT updated";
		}
		
	}	else echo "Please enter an email";
?>