<?php
namespace ref98;

use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AutoDB
{
    public function checkChangesOnModels()
    {
        $namespace = 'App\\Models\\';
        $directory = __DIR__ . '/app/Models';

        $models = array();
        foreach (glob("{$directory}/*.php") as $filename) {
            $classname = $namespace . basename($filename, '.php');
            if (class_exists($classname)) {
                $models[] = $classname;
            }
        }

        print_r($models);


        return $models;
    }


    public static function checkModel(Model $class)
    {

        $file = 'path/to/file.php';

        $checksum = md5_file($file);


    }
}


