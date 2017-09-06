<?php
$servername = "localhost";
$username = "root";
$password = "";
$base_url = 'http://localhost/luisaviaroma';

// Se non accetta la privacy policy lo rimando alla home.
$privacypolicy = isset($_POST['privacypolicy']) ? true : false;
if (!$privacypolicy) {
	header("Location:$base_url");
}

// Campi del form
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$country = isset($_POST['country']) ? $_POST['country'] : null;

// Query
$sql = "INSERT INTO user (firstname, lastname, email, country) VALUES ('$firstname', '$lastname', '$email', '$country')";

try {
	$conn = new PDO("mysql:host=$servername;dbname=database_test", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$statement = $conn->prepare($sql);
	$statement->execute();
	
	header("Location:$base_url?success=true");
} catch(PDOException $e) {
    header("Location:$base_url?success=false");
}

?>
