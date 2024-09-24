<?php require "config/app.php";

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}


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