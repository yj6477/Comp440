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
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($password_2)) { array_push($errors, "Password is required"); }
  if (empty($firstname)) { array_push($errors, "Firstname is required"); }
  if (empty($lastname)) { array_push($errors, "lastname is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  $user_check_query = "SELECT * FROM Users WHERE username='$username'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO Users(username, password, firstname, lastname, email) 
  			  VALUES('$username', '$password_1','$firstname', '$lastname', '$email')";
  	mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password_1;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
  //Login User
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        //$password = md5($password);
        $query = "SELECT * FROM Users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password/email combination");
        }
    }
}
if (isset($_POST['initialize'])) {
  if(strcmp("john", $_SESSION['username']) === 0 && strcmp("pass1234", $_SESSION['password']) === 0)
  {
  $query = '';
  $sqlScript = file('BlogSite.sql');
  foreach ($sqlScript as $line)	{
	
	$startWith = substr(trim($line), 0 ,2);
	$endWith = substr(trim($line), -1 ,1);
	
	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
		continue;
	}
		
	$query = $query . $line;
	if ($endWith == ';') {
		mysqli_query($db,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
		$query= '';		
	}
}
$query = "DROP TRIGGER IF EXISTS atMost1CommentPerBlog;";
mysqli_query($db,$query);
$query = "DROP TRIGGER IF EXISTS noSelfComment;";
mysqli_query($db,$query);
$query = "DROP TRIGGER IF EXISTS atMost2BlogsPerDay;";
mysqli_query($db,$query);
$query = "DROP TRIGGER IF EXISTS atMost3CommentsPerDay;";
mysqli_query($db,$query);
$query = "CREATE TRIGGER `atMost1CommentPerBlog` BEFORE INSERT ON `Comments` FOR EACH ROW BEGIN
    DECLARE rowcount INT;
    SELECT COUNT(*) INTO rowcount FROM comments
    WHERE New.blogid =  Comments.blogid AND New.author = Comments.author;
    IF (rowcount >= 1) THEN
       signal sqlstate '45000' set message_text = 'Only 1 comment per blog.';
    END IF;
END;";
echo $query;
mysqli_multi_query($db,$query)  or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');

$query = '';
$query .= "CREATE TRIGGER `atMost2BlogsPerDay` BEFORE INSERT ON `Blogs` 
FOR EACH ROW BEGIN
       DECLARE rowcount INT;
       SELECT COUNT(*) INTO rowcount FROM blogs
       WHERE postuser = NEW.postuser AND pdate = CURDATE();
       IF (rowcount >= 2) THEN
          signal sqlstate '45000' set message_text = 'You can not post more than two blogs a day! Please try tomorrow.';
       END IF;
END;";
echo $query;
mysqli_multi_query($db,$query)  or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');

$query = '';
$query .= "CREATE TRIGGER `noSelfComment` BEFORE INSERT ON `comments`
 FOR EACH ROW BEGIN	
	DECLARE rowcount INT;
    SELECT COUNT(*) INTO rowcount FROM blogs	
    WHERE NEW.blogid = Blogs.blogid AND New.author = Blogs.postuser;
    IF (rowcount >= 1) THEN	
    	signal SQLSTATE '45000' set MESSAGE_TEXT = 'No self comment.';
        END IF;
END;";
echo $query;
mysqli_multi_query($db,$query)  or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');

$query = '';
$query .= "CREATE TRIGGER `atMost3CommentsPerDay` BEFORE INSERT ON `comments`
FOR EACH ROW BEGIN
     DECLARE rowcount INT;
     SELECT COUNT(*) INTO rowcount FROM comments
     WHERE author = NEW.author AND cdate = CURDATE();
     IF (rowcount >= 3) THEN
       signal sqlstate '45000' set message_text = 'You can not post more than three comments a day! Please try tomorrow.';
     END IF;
END;";
mysqli_multi_query($db,$query)  or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');



echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
$_SESSION['success'] = "The database has been created";
header('location: index.php');
}
else {
  array_push($errors, "Incorrect User. Must be john to perform this action");

}
}
if (isset($_POST['create_blog'])) {
  mysqli_multi_query($db,$query);
  date_default_timezone_set('America/Los_Angeles');
  $subject = mysqli_real_escape_string($db, $_POST['subject']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $username = $_SESSION['username'];
  $date = date("Y-m-d");
  $tags = mysqli_real_escape_string($db, $_POST['tags']);
  $pieces = explode(", ",$tags);
  $query = "INSERT INTO Blogs(blogid, subject, description, postuser, pdate) VALUES
  (NULL,'$subject','$description','$username', '$date')";
  
  if(mysqli_query($db, $query) === FALSE){
      $_SESSION['restriction'] = mysqli_error($db);
  }
  else{
  $query = "SELECT * FROM Blogs WHERE subject = '$subject' AND description = '$description' AND
  postuser = '$username'";
  $result = mysqli_query($db, $query);
  $blog = mysqli_fetch_assoc($result);
  $blogid = $blog['blogid'];
  $_SESSION['success'] = "Blog has been saved";
  foreach($pieces as $tag)
  {
    $query = ''; 
    $query = "INSERT INTO BlogTags(blogid, tag) VALUES ('$blogid','$tag')";
    mysqli_query($db, $query) or die('<div class="error-response sql-query-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
  }
  }
  header('location: index.php');
}
if (isset($_POST['comment'])){
  date_default_timezone_set('America/Los_Angeles');
  $subject = mysqli_real_escape_string($db, $_POST['subject']);
  $blog_description = mysqli_real_escape_string($db, $_POST['description']);
  $postuser = mysqli_real_escape_string($db, $_POST['postuser']);
  $comment_description = mysqli_real_escape_string($db, $_POST['Comment']);
  $rating = mysqli_real_escape_string($db, $_POST['rate']);
  $username = $_SESSION['username'];
  $date = date("Y-m-d");
  $query = "SELECT * FROM Blogs WHERE subject = '$subject' AND description = '$blog_description' AND
  postuser='$postuser'";
  $result = mysqli_query($db, $query);
  $blog = mysqli_fetch_assoc($result);
  $blogid = $blog['blogid'];
  $query = "INSERT INTO Comments(commentid, sentiment, description, cdate, blogid, author) VALUES 
  (NULL, '$rating','$comment_description','$date','$blogid','$username');";
   if(mysqli_query($db, $query) === FALSE)
   {
    $_SESSION['restriction'] = mysqli_error($db);
  }
else{
  $_SESSION['success'] = "Comment has been saved";
}
  header('location: index.php');
}
if(isset($_POST['query1'])){
  $_SESSION['query1'] = mysqli_real_escape_string($db, $_POST['user1-1']);
  header('location: query1.php');
}
if (isset($_POST['query3'])) {
  $_SESSION['query3-1'] = mysqli_real_escape_string($db, $_POST['user1-2']);
  $_SESSION['query3-2'] = mysqli_real_escape_string($db, $_POST['user2-2']);
  header('location: query3.php');
}
if (isset($_POST['query'])) {
  $value = mysqli_real_escape_string($db, $_POST['query']);
  $_SESSION['query'] = $value;
  echo $_SESSION['query'];
  // $query = "enter";
  // mysqli_query($db, $query) or die('<div class="error-response sql-query-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
   header('location: query.php');
}
?>