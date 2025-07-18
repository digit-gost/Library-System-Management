<?php
$author_name = $_GET['author_name'];
$author_id = $_GET['author_id'];
$api_key = '68ee5a41b855f7b008be8286ba220b38736b6d1e82fe245c52cd943723e8095d';
$search_url = "https://serpapi.com/search.json?q=" . urlencode($author_name) . "&tbm=isch&api_key=$api_key";

// Récupérer le JSON SerpAPI
$json = file_get_contents($search_url);
$data = json_decode($json, true);
$image_url = $data['images_results'][0]['original'] ?? null;

if ($image_url) {
    // Télécharger l'image
    $img_data = file_get_contents($image_url);
    $img_path = "images/auteurs/" . strtolower(str_replace(' ', '_', $author_name)) . ".webp";
    file_put_contents($img_path, $img_data);

    // Mettre à jour la base
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $stmt = $connection->prepare("UPDATE authors SET author_image=? WHERE author_id=?");
    $stmt->bind_param("si", $img_path, $author_id);
    $stmt->execute();
    echo "Image ajoutée!";
} else {
    echo "Aucune image trouvée.";
}
?>