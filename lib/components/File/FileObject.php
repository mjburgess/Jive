<?php

namespace Jive\File;

class FileObject {
    private $contents;
        public function getContents() {
            return $this->contents;
        }

        public function setContents($contents) {
            $this->contents = $contents;
            return $this;
        }

    private $name;
        public function setName($name) {
            if(!$this->name = stream_resolve_include_path($name)) {
                $this->name = $name;
            }

            $this->info = pathinfo($name);

            return $this;
        }
        public function getName() {
            return $this->name;
        }

        public function exists() {
            //already include-path resolved
            return file_exists($this->name);
        }

     private $info;
        public function getInfo() {
            return $this->info;
        }

    public function __construct($name, $contents = null) {
        $this->setContents($contents);
        $this->setName($name);
    }
}