<?php
	require("functions.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Mon Profile </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="view_profile.php">Voir Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="edit_profile.php">Modifier Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">Changer de Mot de passe</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../logout.php">Déconnexion</a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
		<div class="container-fluid">
			
		    <ul class="nav navbar-nav navbar-center">
		      <li class="nav-item">
		        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Livres </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_book.php">Ajouter un nouveau livre</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_book.php">Gestion de livres</a>
	        	</div>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_cat.php">Ajouter une catégorie</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_cat.php">Gestion de catégorie</a>
	        	</div>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Auteurs</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_author.php">Ajouter un auteur</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_author.php">Gestion des auteurs</a>
	        	</div>
		      </li>
	          <li class="nav-item">
		        <a class="nav-link" href="issue_book.php">Emprunter un livre</a>
		      </li>
		    </ul>
		</div>
	</nav><br>
    <span><marquee>Bienvenue dans le Système de Librairie Virtuelle. La librarie ouvre à at 8:00 du matin et ferme à 20:00 </marquee></span><br><br>
	<div class="row">
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Utilisateurs Enregistrés</div>
				<div class="card-body">
					<p class="card-text">N°. total d'utilisatuers: <?php echo get_user_count();?></p>
					<a class="btn btn-danger" href="Regusers.php" target="_blank">Voir utilisateurs enregistrés</a>
				</div>
			</div>
		</div>
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Total de Livres</div>
				<div class="card-body">
					<p class="card-text">No de livres disponibles: <?php echo get_book_count();?></p>
					<a class="btn btn-success" href="Regbooks.php" target="_blank">Voir tous les livres</a>
				</div>
			</div>
		</div>
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Catégories de Livres</div>
				<div class="card-body">
					<p class="card-text">No de catégories de livres: <?php echo get_category_count();?></p>
					<a class="btn btn-warning" href="Regcat.php" target="_blank">Voir Catégories</a>
				</div>
			</div>
		</div>
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Nombres d'auteurs</div>
				<div class="card-body">
					<p class="card-text">N° d'Auteurs: <?php echo get_author_count();?></p>
					<a class="btn btn-primary" href="Regauthor.php" target="_blank">VOir Auteurs</a>
				</div>
			</div>
		</div>
	</div><br><br>
	<div class="row">
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Book Issued</div>
				<div class="card-body">
					<p class="card-text">No of book issued: <?php echo get_issue_book_count();?></p>
					<a class="btn btn-success" href="view_issued_book.php" target="_blank">View Issued Books</a>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>
		<div class="col-md-3"></div>
	</div>
</body>
</html>
