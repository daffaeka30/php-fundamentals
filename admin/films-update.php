<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}

$title = "Update Film";
require "layout/header.php";

$id_film = (int)$_GET['id_film'];

$films = select("SELECT * FROM films WHERE id_film = $id_film")[0];
$categories = select("SELECT * FROM categories ORDER BY created_at DESC");

if(isset($_POST['submit'])) {
    if(update_film($_POST) > 0) {
        echo "<script>
            alert('Film has been updated');
            document.location.href = 'films.php';
            </script>";
    } elseif (update_film($_POST) === 0) {
        echo "<script>
            alert('No changes were made');
            document.location.href = 'films.php';
            </script>";
    } else {
        echo "<script>
            alert('Film has not been updated');
            document.location.href = 'films-update.php?id_film=$id_film';
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
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <form action="" method="POST">
                            <input type="hidden" name="id_film" value="<?= $films['id_film']; ?>">
                            <div class="row">
                            <div class="mb-3">
                                <label for="url">URL <small>(copy from youtube)</small></label>
                                <input type="text" class="form-control" id="url" name="url" value="<?= $films['url']; ?>" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $films['title']; ?>" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="<?= $films['slug']; ?>" required>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required><?= $films['description']; ?></textarea>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="release_date">Release Date</label>
                                <input type="date" class="form-control" id="release_date" name="release_date" value="<?= $films['release_date']; ?>" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="studio">Studio</label>
                                <input type="text" class="form-control" id="studio" name="studio" value="<?= $films['studio']; ?>" required>
                            </div>
                            </div>
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="is_private">Private</label>
                                <select name="is_private" id="is_private" class="form-select" required>
                                    <option value="" hidden>== Select ==</option>
                                    <option value="0" <?= $films['is_private'] == 0 ? 'selected' : ''; ?>>Public</option>
                                    <option value="1" <?= $films['is_private'] == 1 ? 'selected' : ''; ?>>Private</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="id_category">Category</label>
                                <select name="id_category" id="id_category" class="form-select" required>
                                    <option value="" hidden>== Select ==</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id_category']; ?>" <?= $films['id_category'] == $category['id_category'] ? 'selected' : ''; ?>><?= $category['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            </div>
                            <div class="float-end">
                                <a href="films.php" class="btn btn-danger"><i class="bi bi-x-circle"></i> Cancel</a>                  
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