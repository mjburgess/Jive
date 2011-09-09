<?php
namespace Jive;

use Jive\File\FileAccess;

class File {
    private static $store;
        public static function GetStore() {
            if(!self::$store instanceof Data\Store) {
                self::$store = new Data\Store();
            }

            return self::$store;
        }

    public static function Name($filename) {
        return new FileAccess($filename);
    }

    public static function Cache($filename) {
        $store = self::GetStore();

        if($store->has($filename)) {
            $data = $store->get($filename);
        } else {
            $data = new FileAccess($filename);

            $store->add($filename, $data);
        }

        return $data;
    }
}