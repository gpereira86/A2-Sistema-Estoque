<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./front-end/view/assets/img/web/favicon16.png" sizes="16x16" type="image/x-icon">
  <link rel="icon" href="./front-end/view/assets/img/web/favicon32.png" sizes="32x32" type="image/x-icon">
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

<?php $contentFile != 'login' ? include_once 'partials/footer.php' : null; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" ></script>
<script src="./front-end/view/assets/js/main.js"></script>
<script src="./assets/js/includePage.js"></script>

</body>
</html>