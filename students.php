<?php 

session_start();
$mysql=mysqli_connect("localhost","root","","profile")or die(mysql_error());
?>
<html>
<body>
<?php	
$name="";
$id="";
$email="";
$state=FALSE;

if(isset($_GET['edit'])){

	$id=$_GET['edit'];
	$rec=mysqli_query($mysql,"SELECT * FROM students WHERE id=$id");
	$record=mysqli_fetch_array($rec);
$state=true;
	$name=$record['name'];
	$email=$record['email'];
	$id=$record['id'];
}


if(isset($_SESSION['msg'])):{

echo $_SESSION['msg'];
unset($_SESSION['msg']);
}
	endif ?>

<form action="../profile/insert.php" id="studform" method="post">
	<input type="hidden" name="id" value="<?=$id;?>"> 
	<label>Name:</label>
	<input type="text" name="studname" value="<?=$name;?>" id="studname">
	<label>Email</label>
	<input type="text" name="email" id="email" value="<?=$email;?>">
	<?php if($state==FALSE): ?>
	<input type="submit" name="submitbn" value="save" id="submitbn">
	<?php else: ?>
		<input type="submit" name="submitbn2" id="submitbn" value="update">
	<?php endif ?>
</form>

<?php 

$get="SELECT * FROM students";
$result=mysqli_query($mysql,$get);
if(mysqli_num_rows($result)>0){

	foreach ($result as $key => $value) {
		?>
		<div><?php echo $value['name'];?>-<?php echo $value['email'];?>-<a href="students.php?edit=<?php echo $value['id'];?>">Edit</a>-<a href="insert.php?id=<?php echo $value['id'];?>">Delete</a></div><?php
	}
}


?>
</body>



</html>

<?php
?>