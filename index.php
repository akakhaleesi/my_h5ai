
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville|Mali" rel="stylesheet">
</head>
<body>

<div class="container">
  <div class="top">
    <div class="tools">
      <p>Trier par : </p>
      <form method="post" action=""><input type="hidden" name="order" value="size"><input type="submit" value="taille"></form>
      <form method="post" action=""><input type="hidden" name="order" value="last-mod"><input type="submit" value="date"></form>
    </div>
  </div>
  <div class="corp">

  <?php
  define('BASE_URI', str_replace('\\', '/', substr(__DIR__,strlen($_SERVER['DOCUMENT_ROOT']))));
  require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));
  $url = substr($_SERVER['REQUEST_URI'], strlen(BASE_URI));

  $controller = new Controller\Controller();
  $controller->init($url);
  ?>

  </div>
</div>

<link type="text/css" rel="stylesheet" href= <?= BASE_URI.'/public/reset.css' ?> >
<link type="text/css" rel="stylesheet" href= <?= BASE_URI.'/public/style.css' ?> >
<script type="text/javascript" src= <?= BASE_URI.'/public/jquery.js' ?> ></script>
<script type="text/javascript" src= <?= BASE_URI.'/public/script.js' ?> ></script>

</body>
</html>
