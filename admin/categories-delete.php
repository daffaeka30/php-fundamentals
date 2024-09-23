<?php require "config/app.php";

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