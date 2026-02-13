<?php 

namespace App\Helper;

class Environment {
  # Set Environmental variables

  # Path Compared to this directory

  public static function setenv() {
    $filepath = __DIR__ . '/../../.env';
    $env = file_get_contents($filepath);
    $lines = explode("\n",$env);

    foreach($lines as $line) {
      // echo preg_match("/([^#]+)\=(.*)/",$line,$matches);
      if(preg_match("/([^#]+)\=(.*)/", $line, $matches)) {
        // echo $line;
        $remove[] = '"';
        $remove[] = "'";
        putenv(trim($line));
      }
    } 

    $dev_env = (getenv("DEV_ENV") == 'true') ? true : false;

    if ($dev_env) {
      ini_set('display_errors', '1');
      ini_set('display_startup_errors', '1');
      error_reporting(E_ALL);
    }
  }
}

?>
