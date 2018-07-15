<?php

session_start();
$mysql=mysqli_connect("localhost","root","","profile")or die(mysql_error());

if(isset($_POST['submitbn'])=="save"){

$name=$_POST['studname'];
$email=$_POST['email'];


$file=$_FILES['fileToUpload'];
$filename=$_FILES['fileToUpload']['name'];
$filetmp=$_FILES['fileToUpload']['tmp_name'];
$filesize=$_FILES['fileToUpload']['size'];
$fileerror=$_FILES['fileToUpload']['error'];
$filetype=$_FILES['fileToUpload']['type'];

$fileext=explode('.', $filename);
$fileActualext=strtolower(end($fileext));

$allowed=array('jpg','jpeg');

if(in_array($fileActualext,$allowed)){


	$filenewname=uniqid('',true).".".$fileActualext;
	$filedestn='uploads/'.$filenewname;
	move_uploaded_file($filetmp, $filedestn);


$query="INSERT INTO students (name,email,photo) VALUES ('$name','$email','$filenewname')";


if(mysqli_query($mysql,$query)){

	$_SESSION['msg']="success";
}
else{
	$_SESSION['msg']="failed";
}

}
else{


	$_SESSION['msg']="upload failed";
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