<?php
session_start();
$_SESSION['message'] = '';
$mysqli = new mysqli('localhost','root','mypass123','accounts');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if($_POST['password'] == $_POST['confirmpassword']){
     $username = $mysqli->real_escape_string($_POST['username']);
$email = $mysqli->real_escape_string($_POST['eamil']); 
$password = md5($_POST['password']);
$avatar_path = $mysqli->real_escape_string('image/*.$_FILES['avatar']['name']);

if(preg_match("!image!",$_FILES['avatar']['type'])){

if(copy($_FILES['avatar']['tmp_name'],$avatar_path)){
$_SESSION['username'] = $username;
$_SESSION['avatar'] = $avatar_path;

$sql = "INSERT INTO users (username,email,password,avatar)"
        ."VALUES ('$username','$email','$password','$avatar_path')";

if($mysqli->query($sql)  == true){
  $_SESSION['message'] = 'Registration successful! Added $username to the database!';
  header("location: welcome.php");
}
}
}
}
}

?>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text">
<link rel="stylesheet" href="form.css" type="text/css">
<div class="body-content">
<div class="module">
<h1>Create an account</h1>
<form class="form" action="form.php" methods="post" enctype="multipart/form-data" autocomplete="off">
<div class="alert alert-error"><?= $_SESSION['message'] ?></div>
<input type="text" placeholder="User Name" name="username" required />
<input type="email" placeholder="Email" name="email" required />
<input type="password" placeholder="Password" name="password" autocomplete="new password" required />
<input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new password" required />
<div class="avatar"><label>Select you profile picture: </label><input type="file" name="avatar" accept="image/*" required /></div>
<input type="submit" value="register" name="register" class="btn btn-block btn-primary" />
</form>
</div>
</div>

