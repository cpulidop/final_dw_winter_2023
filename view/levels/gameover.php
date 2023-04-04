<?php

require_once(__DIR__ . "/../../controller/GameController.php");
require_once(__DIR__ . "/../../view/templates/ViewTemplate.php");
$view = new ViewTemplate();

session_start();
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
            <div class="row">
                <div class="form-group col-md-6">
                    Sorry you don't have more lives left.
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo $view->getFooter(); ?>


