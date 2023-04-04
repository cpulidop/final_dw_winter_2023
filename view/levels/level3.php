<?php

require_once(__DIR__ . "/../../controller/GameController.php");
require_once(__DIR__ . "/../../view/templates/ViewTemplate.php");
$game = new GameController();
$view = new ViewTemplate();
$setSigned = "";
$set = "";
$answer = "";
$gameInfo = [];
$status = "";
$validationClass = "";

session_start();

if (!isset($_SESSION["game"])) {
    $game->newGame();
}

$gameInfo = $_SESSION["game"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validate = $game->level3($_POST);

    if ($validate["success"]) {
        $game->success();
        $status = "success";
        $gameInfo = $_SESSION["game"];

        $set = $validate["set"];
        $answer = $validate["answer"];
        $validationClass = "border-success";
        $view->success("Level 3", "You did it!");
    } else {
        $gameInfo["lives"] = $game->fail();
        $view->error($validate["message"]);
        $status = "fail";
        $set = $validate["set"];
        $setSigned = $validate["setSd"];
        $answer = $validate["answer"];

        $validationClass = "border-error";
    }
} else {
    $sets = $game->getSetByLevel(3);

    $set = $sets["set"];
    $setSigned = $sets["setSigned"];

}

?>
<?php echo $view->getHeader(); ?>



<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Game Level 3</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        Lives: <?php echo $gameInfo["lives"]; ?>
    </div>
    <div class="card-body">
        <form method="post" action="level3.php">
            <div class="row">
                <div class="form-group col-md-12">
                    <p>
                        Order numbers in ascending order.<br>
                        A set of 6 different numbers generated randomly
                        is shown and the user must use the form available
                        to write them in ascending order (from 0 to 100).
                    </p>
                </div>
                <div class="form-group col-md-12">
                    <input type="hidden" name="setSd" value="<?php echo $setSigned; ?>">
                    <label class="form-label">Numbers to order</label>
                    <input type="text" name="set" class="form-control" readonly="readonly" value="<?php echo $set; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label class="form-label">Numbers ordered</label>
                    <input
                            type="text" name="answer"
                            value="<?php echo $answer; ?>" class="form-control
                            <?php echo $validationClass; ?>" required="required"
                            value="" autocomplete="false"
                    >
                </div>
                <hr>
                <div class="col-md-4">
                    <?php if ($status != "success"): ?>
                        <button type="submit" class="btn btn-dark">Validate</button>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if ($gameInfo["level"] > 3): ?>
                        <a href="level3.php" class="btn btn-secondary">
                            Try Again this Level
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if ($gameInfo["level"] > 3): ?>
                        <a href="level4.php" class="btn btn-success">
                            Go the Next Level
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo $view->getFooter(); ?>


