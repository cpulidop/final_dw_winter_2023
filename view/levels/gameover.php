<?php

require_once(__DIR__ . "/../../controller/GameController.php");
require_once(__DIR__ . "/../../view/templates/ViewTemplate.php");
$view = new ViewTemplate();
$game = new GameController();

if (isset($_SESSION["game"]["lives"]) && $_SESSION["game"]["lives"] > 0) {
    header("Location: level" . $_SESSION["game"]["level"] .".php");
    exit;
}

$game->finish($_SESSION);
unset($_SESSION["game"]);

?>
<?php echo $view->getHeader(); ?>



<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Game Over</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">

    </div>
    <div class="card-body">
        <form>
            <div class="row" style="text-align: center;">
                <div class="form-group col-md-12">
                    Sorry you don't have more lives left.
                </div>
                <div class="col-md-12">
                    <a class="btn btn-dark" href="<?= BASE_URL . "/view/home.php" ?>">Go Home</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo $view->getFooter(); ?>


