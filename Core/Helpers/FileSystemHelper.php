<?php

namespace Core\Helpers;

class FileSystemHelper  // @todo нагуглил, это для deploy_helper.php
{

    public static function copy_folder($d1, $d2, $upd = true, $force = true)
    {
        if (is_dir($d1)) {
            $d2 = self::mkdir_safe($d2, $force);
            if (!$d2) {
                self::fs_log("!!fail $d2");
                return;
            }
            $d = dir($d1);
            while (false !== ($entry = $d->read())) {
                if ($entry != '.' && $entry != '..')
                    self::copy_folder("$d1/$entry", "$d2/$entry", $upd, $force);
            }
            $d->close();
        } else {
            $ok = self::copy_safe($d1, $d2, $upd);
            $ok = ($ok) ? "ok-- " : " -- ";
            self::fs_log("{$ok}$d1");
        }
    }

    public static function mkdir_safe($dir, $force)
    {
        if (file_exists($dir)) {
            if (is_dir($dir)) return $dir;
            else if (!$force) return false;
            unlink($dir);
        }
        return (mkdir($dir, 0777, true)) ? $dir : false;
    }


    public static function copy_safe($f1, $f2, $upd)
    {
        $time1 = filemtime($f1);
        if (file_exists($f2)) {
            $time2 = filemtime($f2);
            if ($time2 >= $time1 && $upd) return false;
        }
        $ok = copy($f1, $f2);
        if ($ok) touch($f2, $time1);
        return $ok;
    } //function copy_safe

    public static function fs_log($str)
    {
        $log  = fopen("./fs_log.log", "a");
        $time = date("Y-m-d H:i:s");
        fwrite($log, "$str ($time)\n");
        fclose($log);
    }

}