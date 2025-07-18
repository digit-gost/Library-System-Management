<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>LMS</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	#main_content{
		padding: 50px;
		background-color: whitesmoke;
	}
	#side_bar{
		background-color: whitesmoke;
		padding: 50px;
		width: 300px;
		height: 450px;
	}
</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Library Management System (LMS)</a>
			</div>
	
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item">
		        <a class="nav-link" href="admin/index.php">Admin Connexion</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="signup.php"></span>S'enregistrer</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="index.php">Connexion</a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee>Bienvenue dans le Système de Librairie Virtuelle. La librarie ouvre à at 8:00 du matin et ferme à 20:00 </marquee></span><br><br>
	<div class="row">
		<div class="col-md-4" id="side_bar">
			<h5>Nos Horaires</h5>
			<ul>
				<li>Ouverture: 8h</li>
				<li>Closing: 20h</li>
				<li>Samedi Off</li>
			</ul>
			<h5>Nos services ?</h5>
			<ul>
				<li>Panoplie de fourniture</li>
				<li>Wifi Gratuit</li>
				<li>Journaux</li>
				<li>Sale de Discussion</li>
				<li>Environnement calme</li>
			</ul>
		</div>
		<div class="col-md-8" id="main_content">
			<center><h3><u>Formulaire Connexion Utilisateur</u></h3></center>
			<form action="" method="post">
				<div class="form-group">
					<label for="email">Email ID:</label>
					<input type="text" name="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Mot de Passe:</label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<button type="submit" name="login" class="btn btn-primary">Connexion</button> |
				<a href="signup.php"> Pas encore dans la plateforme ?</a>	
			</form>
			<?php 
				if(isset($_POST['login'])){
					$connection = mysqli_connect("localhost","root","");
					$db = mysqli_select_db($connection,"lms");
					$query = "select * from users where email = '$_POST[email]'";
					$query_run = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($query_run)) {
						if($row['email'] == $_POST['email']){
							if($row['password'] == $_POST['password']){
								$_SESSION['name'] =  $row['name'];
								$_SESSION['email'] =  $row['email'];
								$_SESSION['id'] =  $row['id'];
								header("Location: books_list.php");
							}
							else{
								?>
								<br><br><center><span class="alert-danger">Imposteur, Dégages 😡!!</span></center>
								<?php
							}
						}
					}
				}
			?>
		</div>
	</div>
</body>
</html>
