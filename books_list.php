<?php
session_start();
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"lms");
$query = "SELECT books.*, authors.author_name 
          FROM books 
          LEFT JOIN authors ON books.author_id = authors.author_id";$query_run = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des Livres</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="books_list.php">Library Management System (LMS)</a>
            </div>
            <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
            <font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
            <ul class="nav navbar-nav navbar-right">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Mon Profile </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="view_profile.php">Voir Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="user_dashboard.php">Mon Dashboard</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="edit_profile.php">Modifier Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="change_password.php">Changer de Mot de Passe</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
              </li>
            </ul>
        </div>
    </nav><br>
    <span><marquee>Bienvenue dans le Système de Librairie Virtuelle. La librarie ouvre à at 8:00 du matin et ferme à 20:00 </marquee></span><br><br>
    <div class="container">
        <div class="card bg-light mb-4">
            <div class="card-header">
                <h4 class="mb-0">Liste des Livres</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query_run)): ?>
                            <tr>
                                <td><?php echo $row['book_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['author_name']); ?></td>
                                <td>
                                    <?php if (!empty($row['book_image'])): ?>
                                        <img src="<?php echo $row['book_image']; ?>" width="60" height="60" style="object-fit:cover;">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/60x60?text=No+Image" width="60" height="60" style="object-fit:cover;">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button>
                                        <a class="brn btn-primary" href="documents/codedutravail.pdf" download>Lire/Télécharger</a>
                                    </button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>