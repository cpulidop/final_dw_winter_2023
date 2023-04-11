<?php

require_once(__DIR__ . "/../../controller/GameController.php");
require_once(__DIR__ . "/../../view/templates/ViewTemplate.php");
$game = new GameController();
$view = new ViewTemplate();
$setSigned = "";
$set = "";
$first = "";
$last = "";
$gameInfo = [];
$status = "";
$validationClass = "";

if (!isset($_SESSION["game"])) {
    $game->newGame();
}

$gameInfo = $_SESSION["game"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validate = $game->level5($_POST);

    if ($validate["success"]) {
        $game->success();
        $status = "success";
        $gameInfo = $_SESSION["game"];

        $set = $validate["set"];
        $first = $validate["first"];
        $last = $validate["last"];
        $validationClass = "border-success";
        $view->success("Level 5", "You did it!");
    } else {
        $gameInfo["lives"] = $game->fail();
        $view->error($validate["message"]);
        $status = "fail";
        $set = $validate["set"];
        $setSigned = $validate["setSd"];
        $first = $validate["first"];
        $last = $validate["last"];

        $validationClass = "border-error";
    }
} else {
    $sets = $game->getSetByLevel(5);

    $set = $sets["set"];
    $setSigned = $sets["setSigned"];

}

?>
<?php echo $view->getHeader(); ?>



<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Game Level 5</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        Lives: <?php echo $gameInfo["lives"]; ?>
    </div>
    <div class="card-body">
        <form method="post" action="level5.php">
            <div class="row">
                <div class="form-group col-md-12">
                    <p>
                        Identify first and last letters from a set of letters.<br>
                        A set of 6 different letters generated randomly is shown
                        and the user must use the form available to write the first
                        letter and the last letter (from the order a to z).
                    </p>
                </div>
                <div class="form-group col-md-12">
                    <input type="hidden" name="setSd" value="<?php echo $setSigned; ?>">
                    <label class="form-label">List of Letters</label>
                    <input type="text" name="set" class="form-control" readonly="readonly" value="<?php echo $set; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">First letter</label>
                    <input
                            type="text" name="first"
                            value="<?php echo $first; ?>" class="form-control
                            <?php echo $validationClass; ?>" required="required"
                            value="" autocomplete="false"
                            minlength="1" maxlength="1"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Last letter</label>
                    <input
                            type="text" name="last"
                            value="<?php echo $last; ?>" class="form-control
                            <?php echo $validationClass; ?>" required="required"
                            value="" autocomplete="false"
                            minlength="1" maxlength="1"
                    >
                </div>
                <hr>
                <div class="col-md-4">
                    <?php if ($status != "success"): ?>
                        <button type="submit" class="btn btn-dark">Validate</button>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if ($gameInfo["level"] > 5): ?>
                        <a href="level5.php" class="btn btn-secondary">
                            Try Again this Level
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if ($gameInfo["level"] > 5): ?>
                        <a href="level6.php" class="btn btn-success">
                            Go the Next Level
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo $view->getFooter(); ?>


