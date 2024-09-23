<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}


$title = "Dashboard";
require "layout/header.php";

?>

    <!-- main -->
    <main class="py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        
                        Welcome <?= $_SESSION['username']; ?>!
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam eum ad, ipsam aliquam debitis
                        dolores officia facere. Repudiandae saepe nihil repellat, ad eveniet, ipsam dolor rem nisi
                        cum laudantium soluta.
                    </div>
                    <div class="card-footer">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php

    require "layout/footer.php";

    ?>