<?php
sleep(50);
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");

// Sécurisation des données
$name = mysqli_real_escape_string($connection, $_POST['name']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$password = mysqli_real_escape_string($connection, $_POST['password']);
$mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
$address = mysqli_real_escape_string($connection, $_POST['address']);

// Insertion avec noms de colonnes (id auto-incrémenté)
$query = "INSERT INTO users (name, email, password, mobile, address) VALUES ('$name', '$email', '$password', '$mobile', '$address')";
$query_run = mysqli_query($connection, $query);

if ($query_run) {
    // Récupérer l'ID nouvellement créé
    $id = mysqli_insert_id($connection);

    // Préparer et envoyer l'email
    $subject = "Bienvenue sur la bibliothèque virtuelle";
    $message = "Bonjour $name,\n\nVotre compte a bien été créé.\nVoici vos informations de connexion :\nID utilisateur : $id\nEmail : $email\n\nMerci d'utiliser notre plateforme !";
    $headers = "From: gaston.sankhare@gmail.com";
    mail($email, $subject, $message, $headers);

    echo '<script type="text/javascript">
        alert("Vous êtes enregistré avec succès... Vérifiez votre email !");
        window.location.href = "index.php";
    </script>';
} else {
    echo '<script type="text/javascript">
        alert("Erreur lors de l\'inscription.");
        window.location.href = "register.php";
    </script>';
}
?>