<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}

$title = "Detail Film";
require "layout/header.php";

$id_film = (int)$_GET['id_film'];

$films = select("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.id_category = c.id_category WHERE f.id_film = $id_film")[0];

if (!$films) {
    echo "<script>
            alert('Film not found');
            document.location.href = 'films.php';
          </script>";
}

// $films = select("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.id_category = c.id_category WHERE f.id_film = $id_film");

?>

<!-- main -->
<main class="p-4">
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <i class="bi bi-film"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" style="width:100%">
                                <tr>
                                    <th>Video</th>
                                    <td class="text-center">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $films['url']; ?>?rel=0"
                                        title="<?= $films['title']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
                                        encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen></iframe>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td><?= $films['category_title']; ?></td>
                                </tr>     
                                <tr>
                                    <th>Title</th>
                                    <td><?= $films['title']; ?></td>
                                </tr>       
                                <tr>
                                    <th>Slug</th>
                                    <td><?= $films['slug']; ?></td>
                                </tr>    
                                <tr>
                                    <th>Description</th>
                                    <td><?= $films['description']; ?></td>
                                </tr>   
                                <tr>
                                    <th>Release Date</th>
                                    <td><?= $films['release_date']; ?></td>
                                </tr>   
                                <tr>
                                    <th>Studio</th>
                                    <td><?= $films['studio']; ?></td>
                                </tr>   
                                <tr>
                                    <th>Private</th>
                                    <td><?= $films['is_private'] ? 'Private' : 'Public'; ?></td>
                                </tr>   
                            </table>

                            <div class="float-end">
                                <a href="films.php" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- footer -->

<?php require "layout/footer.php"; ?>