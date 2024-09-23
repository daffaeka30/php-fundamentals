<?php require "config/app.php";

$id_user = (int)$_GET['id'];

if(delete_user($id_user) > 0) {
    echo "<script>
        alert('User has been deleted');
        document.location.href = 'users.php';
        </script>";
} else {
    echo "<script>
        alert('User has not been deleted');
        document.location.href = 'users.php';
        </script>";
}