<?php
	require("functions.php");
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$name = "";
	$email = "";
	$mobile = "";
	$query = "select * from admins where email = '$_SESSION[email]'";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$name = $row['name'];
		$email = $row['email'];
		$mobile = $row['mobile'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un livre</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
  		function alertMsg(){
  			alert(Book added successfully...);
  			window.location.href = "admin_dashboard.php";
  		}
  	</script>
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
	        		<a class="dropdown-item" href="">Voir Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="#">Modifier Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">Changer le Mot de Passe</a>
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
	        		<a class="dropdown-item" href="manage_book.php">Gestion de livvres</a>
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
		<center><h4>Ajouter un nouveau livre</h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="" method="post">
					<div class="form-group">
						<label for="email">Nom du livre:</label>
						<input type="text" name="book_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile">Auteur ID:</label>
						<input type="text" name="book_author" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile">Categorie ID:</label>
						<input type="text" name="book_category" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile">Numéro de livre:</label>
						<input type="text" name="book_no" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile">Prix du livre:</label>
						<input type="text" name="book_price" class="form-control" required>
					</div>
					<button type="submit" name="add_book" class="btn btn-primary">Ajouter livre</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>

<?php
$message = "";
if (isset($_POST['add_book'])) {
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "lms");

    $stmt = $connection->prepare("INSERT INTO books (book_name, author_id, cat_id, book_no, book_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssii",
        $_POST['book_name'],
        $_POST['book_author'],
        $_POST['book_category'],
        $_POST['book_no'],
        $_POST['book_price']
    );
    if ($stmt->execute()) {
        $message = "Livre ajouté avec succès !";
    } else {
        $message = "Erreur lors de l'ajout du livre.";
    }
    $stmt->close();
}
?>

<?php if (!empty($message)) : ?>
    <script>
        alert("<?php echo addslashes($message); ?>");
    </script>
<?php endif;