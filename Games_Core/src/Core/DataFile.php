<?php
/**
 * Created by PhpStorm.
 * User: PCink
 * Date: 2018/07/14
 * Time: 9:15
 */

namespace Core;


class DataFile
{
    private $folderName = '/players';
    private $dir = null;

    public function __construct($name){
        $this->dir = Main::$datafolder . $this->folderName . '/' . strtoupper(substr($name, 0, 1)) . '/' . strtolower($name) . '/';

        if(!file_exists($this->dir)){
            mkdir($this->dir, 0755, true);
        }
    }

    public function write($file, $data = '', $format = 0){
        file_put_contents($this->dir . $file, base64_encode(gzencode(json_encode($data, $format), 9)));
    }

    public function get($file, $bool = true){
        return file_exists($this->dir . $file) ? json_decode(gzdecode(base64_decode(file_get_contents($this->dir . $file))), $bool) : null;
    }

    public static function writeTo($dir, $file, $data = '', $format = 0){
        if(!file_exists($dir)){
            mkdir($dir, 0755, true);
        }
        file_put_contents($dir . $file, base64_encode(gzencode(json_encode($data, $format), 9)));
    }

    public static function readFrom($dir, $file, $bool = true){
        return file_exists($dir . $file) ? json_decode(gzdecode(base64_decode(file_get_contents($dir . $file))), $bool) : null;
    }

    public static function writeToPath($path, $data = '', $format = 0){
        file_put_contents($path, base64_encode(gzencode(json_encode($data, $format), 9)));
    }

    public static function readFromPath($path, $bool = true){
        return file_exists($path) ? json_decode(gzdecode(base64_decode(file_get_contents($path))), $bool) : null;
    }
}