<?php
namespace ref98;

use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ReflectionClass;

class AutoDB
{
    public function getAllModels($namespace, $directory)
    {
        $models = array();
        foreach (glob("{$directory}/*.php") as $filename) {
            $classname = $namespace . '\\' . basename($filename, '.php');
            if (class_exists($classname)) {
                $models[] = $classname;
            }
        }

        print_r($models);


        return $models;
    }


    public function checkModelChanges(String $class)
    {
        $classInstantiated = new ReflectionClass($class);
        $fileName = $classInstantiated->getFileName();

        $file = 'path/to/file.php';

        $checksum = md5_file($file);

        $checksumTesting = '6c5bba47a61e7a1eb03b36471df005b6';

        if($checksum == $checksumTesting)
        {
            //TODO
        }
    }
}


