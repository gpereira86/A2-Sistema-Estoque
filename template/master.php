<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./assets/img/img_logo.png" type="image/x-icon">
  <title><?php echo $title ?? SITENAME; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="http://use.fontawesome.com/releases/v6.2.0/css/all.css"/>
  <Link rel="stylesheet" href="./assets/css/main.css">
  <Link rel="stylesheet" href="./assets/css/header.css">
  <Link rel="stylesheet" href="./assets/css/table.css">
</head>
<body class="fade-in <?php echo $contentFile == 'login' ? 'custom-gradient-bg' : 'custom-light-bg'; ?>" >
<main class="container ">

<?php $contentFile != 'login' ? include_once 'partials/header.php' : null; ?>

<?php echo $content; ?>

</main>

<?php //$contentFile != 'login' ? include_once 'partials/footer.php' : null; ?>

<?php $contentFile != 'login' ? include_once 'partials/modal.php' : null; ?>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" ></script>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/tableorder.js"></script>
<script src="./assets/js/modal.js"></script>


</body>
</html>