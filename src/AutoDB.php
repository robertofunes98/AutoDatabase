<?php
namespace ref98;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AutoDB
{
    public function checkChangesOnModels()
    {
        $models = [];
        $files = Storage::disk('app/Models')->allFiles();

        foreach ($files as $file) {
            if (strpos($file, '.php') !== false) {
                $path = Storage::disk('app/Models')->path($file);
                $contents = File::get($path);
                $namespaces = $this->getNamespacesFromContents($contents);

                foreach ($namespaces as $namespace) {
                    if (strpos($namespace, 'App\Models') !== false) {
                        $models[] = $namespace;
                    }
                }
            }
        }

        return $models;
    }

    private function getNamespacesFromContents($contents)
    {
        $namespaces = [];
        $tokens = token_get_all($contents);
        $namespace = '';

        for ($i = 0; $i < count($tokens); $i++) {
            if ($tokens[$i][0] === T_NAMESPACE) {
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[$j][0] === T_STRING) {
                        $namespace .= '\\' . $tokens[$j][1];
                    } else if ($tokens[$j] === '{' || $tokens[$j] === ';') {
                        $namespaces[] = $namespace;
                        $namespace = '';
                        break;
                    }
                }
            }
        }

        return $namespaces;
    }

    public static function checkModel(Model $class)
    {

        $file = 'path/to/file.php';

        $checksum = md5_file($file);


    }
}


