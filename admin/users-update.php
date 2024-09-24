<?php

$title = 'Update Users';
require "layout/header.php";

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}

$id_user = (int)$_GET['id_user'];

if ($id_user != $_SESSION['id_user'] && $_SESSION['role'] != 'admin') {
    if ($_SESSION['role'] == 'operator' && $users['role'] != 'operator') {
        echo "<script>
                alert('Operator can only update their own account');
                document.location.href = 'users.php';
              </script>";
    }
}

$users = select("SELECT * FROM users WHERE id_user = $id_user")[0];

if (isset($_POST['submit'])) {
    if (update_users($_POST) > 0) {
        echo "<script>
                alert('Users has been updated');
                document.location.href = 'users.php';
            </script>";
    } else {
        echo "<script>
                alert('Users has not been updated');
                document.location.href = 'users-update.php';
            </script>";
    }
}

?>

<!-- main -->
<main class="p-4">
    <div class="containter">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-plus"></i>
                        <?= $title; ?>
                    </div>

                    <div class="card-body shadow-sm">
                        <form action="" method="POST">
                            <input type="hidden" name="id_user" value="<?= $users['id_user']; ?>">
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $users['username'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $users['email'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="" placeholder="isi password baru jika ingin mengganti" value="<?= $users['password'] ?>" required>
                            </div>

                            <div class="float-end">
                                <a href="users.php" class="btn btn-danger"><i class="bi bi-x-circle"></i> Cancel</a>                  
                            </div>

                            <div class="float-end">
                                <button type="submit" class="btn btn-primary me-3" name="submit"><i class="bi bi-upload"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require "layout/footer.php"; ?>