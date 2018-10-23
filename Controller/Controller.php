<?php

namespace Controller;

class Controller {

  public function callMethod($url){var_dump($url);
  //   $method = $_POST['method'];
  //   $params = $_POST['params'];
  //
  //   // $call = new Index;
  //   // $response = $call->$method();
  //
  //   header('Content-Type: application/json');
  //   //echo json_encode(['test' => $this->base_path]);
    echo json_encode('test');
    echo '<h1>YOUHOU</h1>';
  }
}

// class Index {
//
//   protected $index = $_SERVER['DOCUMENT_ROOT'];
//   public $current_path;
//   public $undo_path;
//   public $redo_path;
//   public $datas;
//
//   public function scan_dir(){
//     var_dump('toto');
//     return "return";
//   }
//
//   public function getDirContents(){var_dump($this->current_path);
//     $contents = scandir($this->current_path);
//
//     foreach($contents as $content){
//       $content_path = realpath($this->current_path.DIRECTORY_SEPARATOR.$content);
//
//       if($content != "." && $content != ".."){
//         $content = end(explode('/',$content_path));
//         $this->datas[$content_path] = $content;
//       }
//     }
//     if($this->current_path != $_SERVER['DOCUMENT_ROOT']){
//       $path = explode('/', $this->current_path);
//       $last = count($path);
//       unset($path[$last-1]);
//       $path = implode(DIRECTORY_SEPARATOR, $path);
//       $this->undo_path = $path;
//     }
//
//     return $this->datas;
//   }
// }
