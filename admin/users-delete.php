<?php require "config/app.php";

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}


$id_user = (int)$_GET['id'];

if ($id_user != $_SESSION['id'] && $_SESSION['role'] != 'admin') {
    if ($_SESSION['role'] == 'operator' && $users['role'] != 'operator') {
        echo "<script>
                alert('Operator didn't have permission to delete this user');
                document.location.href = 'users.php';
              </script>";
    }
}

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