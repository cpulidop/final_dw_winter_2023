<?php

    require_once("../controller/MainController.php");
    require_once("../controller/GameController.php");
    $main = new MainController();
    $game = new GameController();

    session_start();
    $game->finish($_SESSION);

    $main->logout();
