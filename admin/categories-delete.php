<?php require "config/app.php";

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}


$id_category = (int)$_GET['id'];

if(delete_category($id_category) > 0) {
    echo "<script>
        alert('Category has been deleted');
        document.location.href = 'categories.php';
        </script>";
} else {
    echo "<script>
        alert('Category has not been deleted');
        document.location.href = 'categories.php';
        </script>";
}