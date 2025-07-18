<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Emprunter un Livre</title>
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
	        		<a class="dropdown-item" href="#">Edit Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">Changer de Mot de Passe</a>
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
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Categorie</a>
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
		<center><h4>Emprunter un livre</h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="" method="post">
					<div class="form-group">
						<label for="book_name">Nom du livre:</label>
						<input type="text" name="book_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="book_author">Auteur ID:</label>
						<select class="form-control" name="book_author">
							<option>-Choisir author-</option>
							<?php  
								$connection = mysqli_connect("localhost","root","");
								$db = mysqli_select_db($connection,"lms");
								$query = "select author_name from authors";
								$query_run = mysqli_query($connection,$query);
								while($row = mysqli_fetch_assoc($query_run)){
									?>
									<option><?php echo $row['author_name'];?></option>
									<?php
								}
							?>
						</select>
						<!--<input type="text" name="book_author" class="form-control" required> -->
					</div>
					<div class="form-group">
						<label for="book_no">ISBN N°:</label>
						<input type="text" name="book_no" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="student_id">ID du USER:</label>
						<input type="text" name="student_id" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="issue_date">Date de remise:</label>
						<input type="text" name="issue_date" class="form-control" value="<?php echo date("yy-m-d");?>" required>
					</div>
					<button type="submit" name="issue_book" class="btn btn-primary">Emprunter le livre</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>

<?php
    $message = "";
    if (isset($_POST['issue_book'])) {
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "lms");

        $book_no = (int)$_POST['book_no'];
        $book_name = mysqli_real_escape_string($connection, $_POST['book_name']);
        $book_author = mysqli_real_escape_string($connection, $_POST['book_author']);
        $student_id = (int)$_POST['student_id'];
        $issue_date = mysqli_real_escape_string($connection, $_POST['issue_date']);

        $query = "INSERT INTO issued_books VALUES (NULL, $book_no, '$book_name', '$book_author', $student_id, 1, '$issue_date')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run){
            $message = "Book issued successfully";
        } else{
            $message = "Error issuing book";
        }
        // header("Location:admin_dashboard.php");
    }
?>

<?php if (!empty($message)) : ?>
    <script>
        alert("<?php echo addslashes($message); ?>");
    </script>
<?php endif; ?>