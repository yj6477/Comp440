<?php include('server.php') ?>
<!DOCTYPE html>
<html lang = "en-US">
<head>
  <title>Registration system PHP and MySQL</title>
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
  		<li><a href="index.php" class = "SectionsItem">Home</a></li>
		<li><a href="initialize.php"class = "SectionsItem">Initialize</a></li>
		<li><a href="comment.php" class="SectionsPresent">Blogs</a></li>
		<li><a href="createblog.php" class="SectionsItem">CreateBlogs</a></li>	
	</ul>
  </nav>
</header>
  <!-- create GUI as described in assignment-->
  <?php $query= "SELECT * FROM Blogs";
  $result = mysqli_query($db, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $subject = $row["subject"];
    $postuser = $row["postuser"];
    $pdate = $row["pdate"];
    $description = $row["description"];
    echo "<button class='accordion'>Subject: $subject &nbsp&nbsp&nbsp&nbsp&nbsp;User: $postuser &nbsp&nbsp&nbsp&nbsp&nbsp;Date: $pdate</button>";
    echo "<div class='panel'>
      <label class ='Sec'>Descriptions</label>
      <p class='descriptions'>$description</p>
      <label class ='Sec'>Rate the post Nigga</label>
      <select name='rate'>
        <option value='positive'>Positive</option>
        <option value='negative'>Negative</option>
      </select>
      <label class = 'Sec'>Comment Section</label>
      <p></p>
      <textarea id='comment' name ='Comment' placeholder='Comment!' style='height: 70px'></textarea>
      <button type='submit' class='btn'>Submit</button>
    </div>";
  
  }
  mysqli_free_result($result);?><br>
  
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