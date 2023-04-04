<?php

require_once("../controller/MainController.php");
require_once("../view/templates/ViewTemplate.php");
$view = new ViewTemplate();

session_start();
if (isset($_SESSION["game"]["level"])) {
    header("Location: levels/level" . $_SESSION["game"]["level"] .".php");
}
?>
<?php echo $view->getHeader(); ?>



<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Home</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">

    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h2 class="h4">Start new Game!</h2>
                    <p>
                        Please click on the button "Start" to begin!
                    </p>
                </div>
                <div class="col-md-12" style="text-align: center">
                    <a class="btn btn-dark" href="<?= BASE_URL ?>/view/levels/level1.php">Start!</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo $view->getFooter(); ?>


