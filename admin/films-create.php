<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}

$title = "Create Film";
require "layout/header.php";

$categories = select("SELECT * FROM categories ORDER BY created_at DESC");

if(isset($_POST['submit'])) {
    if(store_film($_POST) > 0) {
        echo "<script>
            alert('Film has been created');
            document.location.href = 'films.php';
            </script>";
    } else {
        echo "<script>
            alert('Film has not been created');
            document.location.href = 'films-create.php';
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
                    <i class="bi bi-plus"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <form action="" method="POST">
                            <div class="row">
                            <div class="mb-3">
                                <label for="url">URL <small>(copy from youtube)</small></label>
                                <input type="text" class="form-control" id="url" name="url" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" required>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="release_date">Release Date</label>
                                <input type="date" class="form-control" id="release_date" name="release_date" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="studio">Studio</label>
                                <input type="text" class="form-control" id="studio" name="studio" required>
                            </div>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="is_private">Private</label>
                                <select name="is_private" id="is_private" class="form-select" required>
                                    <option value="" hidden>== Select ==</option>
                                    <option value="0">Public</option>
                                    <option value="1">Private</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="id_category">Category</label>
                                <select name="id_category" id="id_category" class="form-select" required>
                                    <option value="" hidden>== Select ==</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id_category']; ?>"><?= $category['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            </div>
                            <div class="float-end">
                                <a href="films.php" class="btn btn-danger"><i class="bi bi-x-circle"></i> Cancel</a>                  
                            </div>
                            <div class="float-end">
                            <button type="submit" class="btn btn-primary me-3" name="submit"><i class="bi bi-plus"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

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

<!-- footer -->

<?php require "layout/footer.php"; ?>