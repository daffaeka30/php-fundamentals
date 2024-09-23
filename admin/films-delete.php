<?php require "config/app.php";

$id_film = (int)$_GET['id'];

if(delete_film($id_film) > 0) {
    echo "<script>
        alert('Film has been deleted');
        document.location.href = 'films.php';
        </script>";
} else {
    echo "<script>
        alert('Film has not been deleted');
        document.location.href = 'films.php';
        </script>";
}