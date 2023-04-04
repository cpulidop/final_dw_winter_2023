<?php

require_once("../controller/MainController.php");
require_once("../view/templates/ViewTemplate.php");
$main = new MainController();
$view = new ViewTemplate();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reset = $main->reset($_POST);

    if ($reset["error"]) {
        $view->error($reset["message"]);
    } else {
        $view->success("Forgot password", $reset["message"]);
    }
}
?>
<?php echo $view->getHeader(false); ?>

<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                            </div>
                            <form method="post" action="reset_password.php">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button class="btn btn-dark btn" type="submit">Reset Password</button>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small link-dark" href="login.php">Sign In</a>
                                <a class="small link-secondary" href="register.php">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<?php echo $view->getFooter(); ?>


