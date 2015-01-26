

<?php
//FacebookSession::setDefaultApplication('345498798970598', '7c271ef014ec40f1ac5a6c27b279f82e');
$helper = new FacebookJavaScriptLoginHelper();
try {
  $session = $helper->getSession();
} catch(FacebookRequestException $ex) {
  // When Facebook returns an error
} catch(\Exception $ex) {
  // When validation fails or other local issues
}
if ($session) {
  // Logged in
}
error_reporting(E_ALL);
ini_set('display_errors', true);
$servername = "localhost";
$username = "root";
$password = "Br92091@";

// Create connection
$conn = new mysqli($servername, $username, $password, "ProjectNARK");

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
$fname = $_POST['Fname'];
$lname = $_POST['Lname'];
$uName=$_POST['Username'];
$dateCreated = date('Y-m-d H:i:s');
//echo (date)($dateCreated);
$sql = "insert into User (User_name,User_created,User_Fname,User_Lname) VALUES('" . $uName . "','" . $dateCreated . "','"  .  $lname . "','"  . $fname . "') ";
 echo htmlspecialchars($sql);
echo date('Y-m-d H:i:s');
 
 if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>