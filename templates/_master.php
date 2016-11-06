<!doctype html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recipe Book</title>
        <link rel="stylesheet" href="css/foundation.css">
        <link rel="stylesheet" href="css/app.css">
        <link rel="icon" type="image/png" href="favicon.png">
    </head>
    <body>
        <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            include 'data/_data.php';
        ?>
        <div>
            <?php include('_menu.php'); ?>
        </div>
        <div>
            <?php
                // if ($content != null) {
                    include($content);
                // } else {
                //     'No content to display';
                // }
            ?>
        </div>
        <div><?php include('_footer.php');?></div>
        <script src="js/vendor/jquery.js"></script>
        <script src="js/vendor/what-input.js"></script>
        <script src="js/vendor/foundation.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>