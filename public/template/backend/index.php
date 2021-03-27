<!DOCTYPE html>
<html lang="en">

<!-- Head-->
<?php require_once 'html/head.php'?>


<body>
    <!-- Header-->
    <?php require_once 'html/header.php'?>
    <?php require_once 'html/main_sidebar_mobile.php'?>
    <div class="ps-site-overlay"></div>
    <main class="ps-main">
           <!-- main sidebar-->
        <?php require_once 'html/main_sidebar.php'?>
        
        <div class="ps-main__wrapper">
              <!-- header dashboard-->
        <?php require_once 'html/header_dashboard.php'?>
            
        <!-- header dashboard-->
        <<?php require_once 'html/content_dashboard.php' ?>
        </div>
    </main>
    <?php require_once 'html/script.php'?>
</body>

</html>