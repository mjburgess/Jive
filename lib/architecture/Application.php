<?php
namespace Jive;

class Application extends Application\AArchitecture {
    private $autoloader;
        public function getAutoloader() {
            return $this->autolader;
        }
        public function setAutoloader($al) {
            $this->autoloader = $al;
        }

    public function autoload() {
        $autoloader  = new Autoloader($this->environment->getApplicationName(),
                                        $this->environment->getApplicationRoot(),
                                        $this->environment->getLibRoot());
        $autoloader->register();
    }
}