<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web server Applications - Final Project</title>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            text-align: center;
            font-family: system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans","Liberation Sans",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        }
        .container{
            max-width: 1000px;
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
            border-radius: 0.375rem;
            margin: auto;
            padding: 30px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="title">
            <h3>Error</h3>
        </div>
        <div class="mensaje">
            <p>
                There's been an error calling the configuration of the project (DB connection or Routes missing)
            </p>
            <p>
                Please check the README.md file and be sure you have follow the instructions to configure the site.
            </p>

            <a href="login.php" class="btn btn-dark" >Go to index</a>
        </div>
    </div>
</body>
</html>
