<?php
/**
 * @var bool $navIsVisible
 */

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Web server Applications - Final Project</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/custom.css"/>

    </head>

    <body>
        <?php include_once("modals.php") ?>

        <?php if($navIsVisible): ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">FINAL - Games</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>/view/home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>/view/scores.php">Scores</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#login">
                        Logout
                    </button>
                </div>
            </div>
        </nav>
        <?php endif; ?>

        <div class="container">
            <!-- Content here -->
            <div class="container-fluid">


