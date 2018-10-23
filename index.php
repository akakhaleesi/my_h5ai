
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>

<pre>
  <?php
  define('BASE_URI', str_replace('\\', '/', substr(__DIR__,strlen($_SERVER['DOCUMENT_ROOT']))));
  $url = substr($_SERVER['REQUEST_URI'], strlen(BASE_URI));

  require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

  $core = new Core\Core();
  $core->run();
  ?>
</pre>

<link type="text/css" rel="stylesheet" href= <?= BASE_URI.'/public/style.css' ?> >
<script type="text/javascript" src= <?= BASE_URI.'/public/jquery.js' ?> ></script>
<script type="text/javascript" src= <?= BASE_URI.'/public/script.js' ?> ></script>

</body>
</html>
