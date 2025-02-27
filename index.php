<?php
//index.php:
require_once "./auto.php";
?>
<html>
    <head>
        <title>Haysaf.com</title>
        <link rel="stylesheet" href="/public/css/w3.css">
        <link rel="stylesheet" href="/public/css/theme-haysaf.css">
    </head>
    <body class="theme-l4 container">

    <nav class="bar theme card">
        <div class="left">
            <a href='/'><img src="/public/img/logo_mini.png" alt="Haysaf Logo" class="image bar-item"></a>
        </div> 
        <div class="right">
         <?php require_once __DIR__."/pageParts/navbar.php";?>
        </div>
    </nav>
    <main class="container  margin-top round">
        <?php  require_once  __DIR__."/job.php";?>
    </main>
    <footer>
        <?php  require_once __DIR__."/pageParts/footer.php";?>

    </footer>
 
    <script src="/public/js/actions.js" defer></script>

    </body>
 
<style>
 .modal-effect{
    opacity: 0;  /* Başlangıçta görünmez */
    visibility: hidden; /* Tamamen gizle */
    transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
 }
 .modal-show{
    opacity: 1; /* Görünür yap */
    visibility: visible;
}
</style>
</html>