<?php include('server.php') ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang = "en-US">
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
.accordion {
  background-color: #b104a2e5;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #df1cdf;
  color: white; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: purple;
  overflow: hidden;
}

.descriptions{
  width: 100%;
  padding: 12px;
  background-color:#b104a2e5; 
  border: 2px solid black;
  border-radius: 4px;
  box-sizing: border-box;
  color: white;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}
.Sec{
  color: white;
}
</style>
</head>
<body>
<header role = "banner">
  <nav role = "navigation" class = "Sections">
  	<ul>
  		<li><a href="index.php" class = "SectionsPresent">Home</a></li>
		<li><a href="initialize.php"class = "SectionsItem">Initialize</a></li>
		<li><a href="comment.php" class="SectionsItem">Blogs</a></li>
		<li><a href="createblog.php" class="SectionsItem">CreateBlogs</a></li>
    <li><a href="display.php" class ="SectionsItem">DisplayQuery</a></li>		
	</ul>
  </nav>
</header>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php  if (isset($_SESSION['username'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
	  <?php  if (isset($_SESSION['restriction'])) : ?>
      <div class="error restriction" >
      	<h3>
          <?php 
          	echo $_SESSION['restriction']; 
          	unset($_SESSION['restriction']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
	<!-- created database --->
	<?php  if (isset($_SESSION['initialize'])) : ?>
	<p> hey congratulations </p>
	<?php endif ?>
	<?php include('errors.php'); ?>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" class = "btn">logout</a> </p>
		<p> Display queries <a href="display.php" class = "btn">GO</a> </p>
		
    <?php endif ?>
</div>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
</body>
</html>