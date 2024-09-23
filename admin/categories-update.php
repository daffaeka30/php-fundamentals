<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}

$title = "Update Category";
require "layout/header.php";

$id_category = (int)$_GET['id_category'];

$categories = select("SELECT * FROM categories WHERE id_category = $id_category")[0];

if(isset($_POST['update'])) {
    if(update_category($_POST) > 0) {
        echo "<script>
            alert('Category has been updated');
            document.location.href = 'categories.php';
            </script>";
    } else {
        echo "<script>
            alert('Category has not been updated');
            document.location.href = 'categories-update.php';
            </script>";
    }
}

?>

<main class="p-4">
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <i class="bi bi-upload"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <form action="" method="POST">
                            <input type="hidden" name="id_category" value="<?= $categories['id_category']; ?>">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $categories['title'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="<?= $categories['slug'] ?>" required>
                            </div>
                            <div class="float-end">
                                <a href="categories.php" class="btn btn-danger"><i class="bi bi-x-circle"></i> Cancel</a>                  
                            </div>
                            <div class="float-end">
                                <button type="submit" class="btn btn-primary me-3" name="update"><i class="bi bi-upload"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <!-- Script -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            $('#title').on('input', function() {
               $('#slug').val(slugify($(this).val()));
            })
        });

        const slugify = (text) => {
            return text.trim()
            .toLowerCase()
            .replace(/\s+/g, '-') // ganti spasi dengan -
            .replace(/[^\w\-]+/g, '') // Hapus karakter non-alphanumeric
            .replace(/-+/g, '-'); // Ganti beberapa - dengan satu
        }
    </script>

<?php require "layout/footer.php"; ?>