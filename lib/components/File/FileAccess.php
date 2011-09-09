<?php
namespace Jive\File;

class FileAccess extends FileParser {
    public function delete() {
        return unlink($this->getName());
    }

    public function move() {}
    public function rename() {}
}