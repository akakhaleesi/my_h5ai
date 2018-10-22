<?php

class Index {

  public $current_path;
  public $undo_path;
  public $redo_path;
  public $datas;

  public function getDirContents($path){
    $this->current_path = $path;
    $contents = scandir($path);

    foreach($contents as $content){
      $path_content = realpath($path.DIRECTORY_SEPARATOR.$content);

      if($content != "." && $content != ".."){
        $content = end(explode('/',$path_content));
        $this->datas[$path_content] = $content;
      }
    }
    if($path != $_SERVER['DOCUMENT_ROOT']){
      $path = explode('/', $path);
      $last = count($path);
      unset($path[$last-1]);
      $path = implode(DIRECTORY_SEPARATOR, $path);
      $this->undo_path = $path;
    }
    return print_r($this->datas);
  }
}

$index = new Index();
$index->getDirContents($_SERVER['DOCUMENT_ROOT']);
