<?php
session_start();

// initializing variables
$username = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'mysql', 'Project');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }

  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  $user_check_query = "SELECT * FROM user WHERE username='$username'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (user_id, username, password) 
  			  VALUES(NULL,'$username', '$password_1')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
  //Login User
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        //$password = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
if (isset($_POST['initialize'])) {
<<<<<<< Updated upstream
  if(strcmp("john", $_SESSION['username']) === 0 && strcmp("pass1234", $_SESSION['password']))
=======
  if(strcmp('john', $_SESSION['username']) === 0 && strcmp('pass1234', $_SESSION['password']) === 0)
>>>>>>> Stashed changes
  {
  $query = '';
  $sqlScript = file('university.sql');
  foreach ($sqlScript as $line)	{
	
	$startWith = substr(trim($line), 0 ,2);
	$endWith = substr(trim($line), -1 ,1);
	
<<<<<<< Updated upstream
	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
=======
  if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//' 
  || $startWith == " 1") {
>>>>>>> Stashed changes
		continue;
	}
		
	$query = $query . $line;
	if ($endWith == ';') {
		mysqli_query($db,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
		$query= '';		
	}
}
<<<<<<< Updated upstream
echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
=======
# echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
>>>>>>> Stashed changes
$_SESSION['success'] = "The database has been created";
header('location: index.php');
}
else {
  array_push($errors, "Incorrect User. Must be john to perform this action");

}
  
}
?>