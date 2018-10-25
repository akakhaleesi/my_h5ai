<?php

namespace Controller;

class Controller {

  public $current_path; // Plain directory from document_root
  public $type_path;

  // ------------ Init
  public function init($url){
    $this->check_url($url);
  }

  // ------------ Set $current_path
  public function setCurrentPath($path){
    $this->current_path = $path;
  }

  // ------------ Check URL
  public function check_url($url){
    $check_path = explode('/', $url);
    $tmp_path = $_SERVER['DOCUMENT_ROOT'];
    $message = '';
    $error = false;

    foreach($check_path as $value){
      if($value != ''){
        $tmp_path .= DIRECTORY_SEPARATOR.$value;
      }
      // URL folder
      if(is_dir($tmp_path)){
        $this->type_path = 'folder';
        $this->setCurrentPath($tmp_path);
      }
      else {
        if(is_file($tmp_path)){
          // URL image
          if(preg_match('/([\w\-])+(.png|.pnj|.jpg|.jpeg|.svg|.gif)$/', $value)){
            $this->type_path = 'image';
            $this->setCurrentPath($tmp_path);
          }
          // URL file
          else{
            $this->type_path = 'file';
            $this->setCurrentPath($tmp_path);
          }
        }
        // URL undefined
        else{
          $error = true;
          $message .= '/'.$value;
        }
      }
    }
    if($error == true) echo "no repository: $message \n";

    $this->scan_dir();
  }

  // ------------ Scan dir/file
  public function scan_dir(){
    $tmp_path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->current_path);
    $undo = explode('/', $tmp_path);
    array_pop($undo);
    $undo = BASE_URI.implode(DIRECTORY_SEPARATOR, $undo);

    // Folder
    if($this->type_path == 'folder'){
      $contents = scandir($this->current_path);
      $datas = [];

      foreach($contents as $content){
        if($this->current_path == $_SERVER['DOCUMENT_ROOT']){
          if($content != '.' && $content != '..'){
            $path = $tmp_path.DIRECTORY_SEPARATOR.$content;
            $datas[$path] = $content;
          }
        }
        else {
          if($content != '.' ){
            $path = $tmp_path.DIRECTORY_SEPARATOR.$content;
            $datas[$path] = $content;
          }
        }
      }
      $this->render($datas);
    }
    // File
    elseif($this->type_path == 'file'){
      echo '<div class="links"><a href="'.$undo.'">Retour</a></div><br>';
      $data = file_get_contents($this->current_path);
      $file = $_SERVER['DOCUMENT_ROOT'].BASE_URI.'/file.txt';

      $old_file = fopen($file, "w");
      fclose($old_file);
      $new_file = fopen($file, 'r+');
      fwrite($new_file, $data);
      echo file_get_contents($file);
      fclose($new_file);
    }
    // Image
    elseif($this->type_path == 'image'){
      echo '<div class="links"><a href="'.$undo.'">Retour</a></div><br>';
      $src = str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->current_path);
      echo '<img src="' . $src . '">';
    }
  }

  // ------------ Render
  public function render($datas){
    // Render pwd
    $tmp_path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->current_path);
    $links = explode('/', $tmp_path);
    $path = '';

    for($i=0; $i<count($links); $i++){
      $folder = $links[$i];
      if($i == 0) $folder = 'Index';

      $path .= $links[$i].DIRECTORY_SEPARATOR;
      $links[$i] = '<a href="'.BASE_URI.$path.'">'.$folder.'</a>';
    }
    $pwd_path = '<p>'.implode(DIRECTORY_SEPARATOR, $links).'</p><br>';
    echo $pwd_path;

    // Render Tree
    $files = [];

    foreach($datas as $path => $data){
      $tmp_path = $_SERVER['DOCUMENT_ROOT'].$path;

      // File
      if(is_file($tmp_path)){
        $file_size = filesize($tmp_path);
        $last_mod = filemtime($tmp_path);
        //if(preg_match('/([\w\-])+(.html)$/', $path)) $favicon = $this->get_favivon($tmp_path);
        //if(isset($favicon)) echo $favicon;
        $params = ['name' => $data, 'path' => BASE_URI.$path, 'size' => $file_size, 'last-mod' => $last_mod];
        array_push($files, $params);
      }
      // Folder
      else{
        echo '<div class="links"><img class="folder-img" src="'.BASE_URI.'/public/folder.png" width="30" height="30"/><a href="'.BASE_URI.$path.'">'.$data.'</a></div><br>';
      }
    }
    $files_array = array_filter($files);

    // Display files
    if (!empty($files_array)) {
      $this->list($files);
    }
  }

  // ------------ List doc
  public function list($files){
    if(isset($_POST['order'])){
      usort($files, function($a, $b) {
        return $a[$_POST['order']] - $b[$_POST['order']];
      });
    }

    foreach($files as $data){
      $file_size = $this->human_filesize($data['size']);
      $last_mod = date("m.d.Y, H:m a", $data['last-mod']);
      echo '<div class="links"><img class="folder-img" src="'.BASE_URI.'/public/file.png" width="25" height="25"/><a href="'.$data['path'].'">'.$data['name'].'</a><p>'.$file_size.' | last mod: '.$last_mod.'</p></div><br>';
    }
  }

  // ------------ Amazing function found on the web <3
  public function human_filesize($bytes, $decimals = 2) {
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return round($bytes / pow(1024, $factor), 2) .' '. @$sz[$factor];
  }

  // ------------ Get favicon
  public function get_favivon($path){
    // $doc = new \DOMDocument();
    // $doc->strictErrorChecking = FALSE;
    // $doc->loadHTML(file_get_contents($path));
    // $xml = simplexml_import_dom($doc);
    // $arr = $xml->xpath('//link[@rel="shortcut icon"]');
    // if($arr) return $arr[0]['href'];
  }
}
