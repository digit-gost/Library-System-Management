<?php
if (isset($_GET['book_name'])) {
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $book_name = mysqli_real_escape_string($connection, $_GET['book_name']);
    $query = "SELECT books.book_no, books.book_title, authors.author_name 
              FROM books 
              LEFT JOIN authors ON books.author_id = authors.author_id 
              WHERE books.book_title = '$book_name' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }
}
?>