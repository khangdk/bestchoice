<!DOCTYPE html>
<html lang="en">

<!-- Head-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="favicon.png" rel="icon">
    <title>Martfury Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/Linearicons/Font/demo-files/demo.css">
    <?php echo $this->_cssFiles;?>
</head>

<body>
    <!-- Header-->
    <?php require_once 'html/header.php' ?>
    <?php require_once 'html/main_sidebar_mobile.php' ?>
    <div class="ps-site-overlay"></div>
    <main class="ps-main">
        <!-- main sidebar-->
        <?php require_once 'html/main_sidebar.php' ?>

        <div class="ps-main__wrapper">
            <!-- header dashboard-->
            <?php require_once 'html/header_dashboard.php' ?>

            <!-- header dashboard-->
            <<?php require_once 'html/content_dashboard.php' ?> </div>
    </main>
    <?php echo $this->_jsFiles;?>
</body>

</html>