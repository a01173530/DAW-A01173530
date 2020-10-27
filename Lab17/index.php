<?php
 
 session_start();
 $conn= new mysqli("localhost", "root", "", "lab17");

 $msg="";

 if(isset($_POST['login'])){
 	$username=$_POST['username'];
 	$password=$_POST['password'];
 	$password= sha1($password);
 	$userType= $_POST['userType'];

 	$sql="SELECT * FROM user WHERE username=? AND password=? AND user_type= ?";
 	$stmt=$conn->prepare($sql);
 	$stmt->bind_param("sss", $username, $password, $userType);
 	$stmt->execute();
 	$result= $stmt->get_result();
 	$row=$result->fetch_assoc();

 	session_regenerate_id();
 	$_SESSION['username']= $row['username'];
 	$_SESSION['role']= $row['user_type'];
 	session_write_close();

 	if($result->num_rows==1 && $_SESSION['role']=="student"){
 		header("location:student.php");
 	}
 	else if($result->num_rows==1 && $_SESSION['role']=="teacher"){
 		header("location:teacher.php");

 	}
 	else if($result->num_rows==1 && $_SESSION['role']=="admin"){
 		header("location:admin.php");

 	}else{
 		$msg="El usuario o contraseña es incorrecto!";
 	}

 }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Lab 17</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body class="bg-dark">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-5 bg-light mt-5 px-0">
				<h3 class="text-center text-light bg-warning p-3">
					Lab 17 RBAC
				</h3>
				<form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="p-4">
					<div class="form-group">
						<input type="text" name="username" class="form-control form-control-lg" placeholder="Usuario" required>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control form-control-lg" placeholder="Contraseña" required>
					</div>

					<div class="form-group lead">
						<label for="userType"> Soy un :</label>
						<input type="radio" name="userType" value="student" class="custom-radio" required>&nbsp;Estudiante |	
						<input type="radio" name="userType" value="teacher" class="custom-radio" required>&nbsp;Maestro |
						<input type="radio" name="userType" value="admin" class="custom-radio" required>&nbsp;Administrador				
					</div>
					<div class="form-group">
						<input type="submit" name="login" class="btn btn-warning btn-block">
					</div>
					<h5 class="text-warning text-center"><?= $msg; ?></h5>
				</form>
				
			</div>
			
		</div>
		
	</div>

</body>
</html>