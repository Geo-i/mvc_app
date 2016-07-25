<?php

class DeployHelper //@todo - заменить на gulp или webpack или phing
{
    public static $assets = [
      [
          'name' => 'bootstrap',
          'for' => '/vendor/twbs/bootstrap',
          'to'  => '/public/vendor/bootstrap',
      ]
    ];

    public static function run()
    {
        chdir(dirname(__DIR__));

        self::updateAssets();
    }

    private static function updateAssets()
    {
        require_once 'Core/Helpers/FileSystemHelper.php';
        foreach (self::$assets as $asset) {
            $for = __DIR__ . $asset['for'];
            $to  = __DIR__ . $asset['to'];
            \Core\Helpers\FileSystemHelper::copy_folder($for, $to);
        }

        echo '---finish';
    }

}

DeployHelper::run();