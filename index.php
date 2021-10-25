<?php
if (isset($_GET['l'])) {
    require_once './database/Database.php';

    $db = new Database($_GET['l']);
}

?>


<!-- Including header -->
<?php include('includes/header.php'); ?>

<!-- Including nav -->
<?php include('includes/nav.php'); ?>

<div class="container">


    <div class="row pt-5 hero-section">
        <div class="col-6 d-flex justify-content-center align-items-center">
            <div>
                <h1>Welcome To LinkCut</h1>

                <p>The link shortener that has your back</p>
                <a href="shorten.php" class="btn btn-outline-success btn-small">Shorten link now</a>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-center align-items-center">
            <img src="assets/images/shortner-hero.svg" alt="shortner-image" class="hero-img img-fluid">
        </div>
    </div>

</div>



?>

<?php include('includes/footer.php'); ?>