<?php

require_once("../controller/GameController.php");
require_once("../view/templates/ViewTemplate.php");
$game = new GameController();
$view = new ViewTemplate();
session_start();

$sessions = $game->getSessions();

if (isset($_SESSION["game"]["level"])) {
    header("Location: levels/level" . $_SESSION["game"]["level"] .".php");
}
?>
<?php echo $view->getHeader(); ?>



<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Scores</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">

    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h2 class="h4">List of Scores!</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Lives Used</th>
                                <th>Date</th>
                            </tr>
                            <?php foreach ($sessions as $session): ?>
                                <tr>
                                    <td><?php echo @$session["username"] ?></td>
                                    <td><?php echo @$session["status"] ?></td>
                                    <td><?php echo @$session["lives"] ?></td>
                                    <td><?php echo @$session["date"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>

<?php echo $view->getFooter(); ?>


