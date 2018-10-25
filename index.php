
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>

<div class="container">
  <?php
  define('BASE_URI', str_replace('\\', '/', substr(__DIR__,strlen($_SERVER['DOCUMENT_ROOT']))));
  require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));
  $url = substr($_SERVER['REQUEST_URI'], strlen(BASE_URI));

  $controller = new Controller\Controller();
  $controller->init($url);
  ?>
</div>

<link type="text/css" rel="stylesheet" href= <?= BASE_URI.'/public/style.css' ?> >
<script type="text/javascript" src= <?= BASE_URI.'/public/jquery.js' ?> ></script>
<script type="text/javascript" src= <?= BASE_URI.'/public/script.js' ?> ></script>

</body>
</html>
