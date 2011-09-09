<?php

namespace Jive\File;

class FileParser extends FileIO {

    public function parse(array $vars = array()) {
        if(!$this->exists()) {
            throw new Exceptions\FileException("File ($this->name) not found!");
        }

        $parser = 'parse' . ucfirst($this->_info['extension']);

        if(!method_exists($this, $parser)) {
            $info = $this->getInfo();
            throw new FileException("Parsing file type ($info[extension]) unsupported!");
        }

        $this->$parser($vars);

        return $this;
    }

    private function parsePhtml(array $vars) {
        extract($vars);
        ob_start();
            include $this->name;
        $this->contents = ob_get_clean();
    }

    private function parseIni(array $vars) {
        $this->contents = parse_ini_file($this->name, true);
    }

    private function parsePhp(array $vars) {
        extract($vars);
        $this->contents = include $this->name;
    }
}