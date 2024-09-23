<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}

$title = "Categories";
require "layout/header.php";

$categories = select("SELECT * FROM categories");

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
                            <a href="categories-create.php" class="btn btn-primary"><i class="bi bi-plus"></i> Create</a>
                            <a href="categories-download.php" class="btn btn-info text-white"><i class="bi bi-download"></i> Download</a>
                            <table id="datatable" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                    <th width="1%">No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($categories as $category) : ?>
                                    <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $category['title']; ?></td>
                                    <td><?= $category['slug']; ?></td>
                                    <td><?= $category['created_at']; ?></td>
                                    <td class="text-center" width="15%">
                                        <a href="categories-update.php?id_category=<?= $category['id_category']; ?>" class="btn btn-sm btn-success mb-1" title="Edit"><i class="bi bi-pen"></i></a>
                                        <a href="categories-delete.php?id=<?= $category['id_category']; ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-sm btn-danger mb-1" title="Delete"><i class="bi bi-trash"></i></a>
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