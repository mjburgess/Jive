<?php

namespace Jive\File;

class FileIO extends FileObject {
    public function read() {
        $this->setContents(file_get_contents($this->getName()));
    }

    public function write() {
        return file_put_contents($this->getName(), $this->getContents());
    }
}