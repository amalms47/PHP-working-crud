<?php

session_start();
$mysql=mysqli_connect("localhost","root","","profile")or die(mysql_error());

if(isset($_POST['submitbn'])=="save"){

$name=$_POST['studname'];
$email=$_POST['email'];

$query="INSERT INTO students (name,email,photo) VALUES ('$name','$email','2')";

if(mysqli_query($mysql,$query)){

	$_SESSION['msg']="success";
}
else{
	$_SESSION['msg']="failed";
}
header('Location: ../profile/students.php');
}






if(isset($_POST['submitbn2'])=="update"){

$name=$_POST['studname'];
$email=$_POST['email'];
$id=$_POST['id'];


$query="UPDATE students SET name='$name',email='$email',photo=3 WHERE  id=$id";

if(mysqli_query($mysql,$query)){

	$_SESSION['msg']="updated";
}
else{
	$_SESSION['msg']="updated failed";
}
header('Location: ../profile/students.php');
}




if(isset($_GET['id'])){

	$id=$_GET['id'];

$query="DELETE FROM students  WHERE  id=$id";

if(mysqli_query($mysql,$query)){

	$_SESSION['msg']="deleted";
}
else{
	$_SESSION['msg']="failed";
}
header('Location: ../profile/students.php');
}


?>