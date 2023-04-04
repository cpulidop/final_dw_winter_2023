<?php

    require_once("../controller/MainController.php");
    require_once("../view/templates/ViewTemplate.php");
    $main = new MainController();
    $view = new ViewTemplate();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validate = $main->login($_POST);

    if (!empty($validate)) {
        session_start();
        $_SESSION["user"] = $validate;
        header("Location: home.php");
    } else {
        $view->error("Invalid login info, please try again.");
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
                    <div class="col-lg-6 d-none d-lg-block">

                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form method="post" action="login.php">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-dark btn" type="submit">Login</button>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small link-secondary" href="reset_password.php">Forgot Password?</a>
                                <a class="small link-dark" href="register.php">Sing Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<?php echo $view->getFooter(); ?>


