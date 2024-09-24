<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}

$title = "Users";
require "layout/header.php";

if($_SESSION['role'] == 'operator') {
    $users = select("SELECT * FROM users WHERE id_user = {$_SESSION['id_user']}");
} else {
    $users = select("SELECT * FROM users");
}

?>

<!-- main -->
<main class="p-4">
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <i class="bi bi-list-task"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <div class="table-responsive">
                            <?php if($_SESSION['role'] != 'admin') : ?>
                            <a href="#" class="btn btn-primary" onclick="alert('Only admin can add data')"><i class="bi bi-plus"></i> Create</a>
                            <?php else : ?>
                            <a href="users-create.php" class="btn btn-primary"><i class="bi bi-plus"></i> Create</a>
                            <?php endif; ?>
                            <table id="datatable" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th width="1%">No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['role']; ?></td>
                                    <td><?= $user['created_at']; ?></td>
                                    <td class="text-center" width="15%">
                                        <a href="users-update.php?id_user=<?= $user['id_user']; ?>" class="btn btn-sm btn-success mb-1" title="Edit"><i class="bi bi-pen"></i></a>
                                        <?php if($_SESSION['role'] == 'admin' && $user['role'] != 'admin') : ?>
                                        <a href="users-delete.php?id=<?= $user['id_user']; ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-sm btn-danger mb-1" title="Delete"><i class="bi bi-trash"></i></a>
                                        <?php elseif($_SESSION['role'] == 'admin' && $user['role'] == 'admin') : ?>
                                        <a href="#" class="btn btn-sm btn-danger mb-1" title="Delete" onclick="alert('Admin can not be deleted')"><i class="bi bi-trash"></i></a>
                                        <?php else : ?>
                                        <a href="#" class="btn btn-sm btn-danger mb-1" title="Delete" onclick="alert('Only admin can delete data')"><i class="bi bi-trash"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- footer -->

<?php require "layout/footer.php"; ?>