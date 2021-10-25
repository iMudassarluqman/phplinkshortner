<?php
if (isset($_POST['submit'])) {
    $db = require_once('./database/Database.php');

    $db = new Database($_POST);
}

?>


<!-- Including header -->
<?php include('./includes/header.php'); ?>

<!-- Including nav -->

<?php include('./includes/nav.php'); ?>

<div class="container">
    <p class="display-6 text-center mt-5">Shorten your links instantly</p>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <p class="text-center my-5 alert-success w-25 mx-auto"><?php echo $db->shorty ?? "" ?></p>

        <div class="row">

            <div class="col-9 d-flex mx-auto  mt-5 justify-content-around">
                <div class="col-9">
                    <input type="text" class="form-control" placeholder="Enter your link.." name="link">
                </div>
                <div class="col-2">
                    <input type="submit" class="btn btn-success" value="Shorten URL" name="submit">
                </div>
            </div>
        </div>
    </form>

</div>




<?php include('./includes/footer.php'); ?>