<?php
namespace Jive\Application;

class Environment {
    const Development = 'dev';
    const Live        = 'live';

    private $libRoot;
        private function setLibRoot($lr) {
            $this->libRoot = $lr;
        }
        public function getLibRoot() {
            return $this->libRoot;
        }

    private $appRoot;
        private function setApplicationRoot($ar) {
            $this->appRoot = $ar;
        }
        public function getApplicationRoot() {
            return $this->appRoot;
        }

    private $appName;
        private function setApplicationName($an) {
            $this->appName = $an;
        }
        public function getApplicationName() {
            return $this->appName;
        }

    private $context;
        private function setContext($ctx) {
            $this->context = $ctx;
        }
        public function getContext() {
            return $this->context;
        }

    public function __construct($libRoot, $appRoot, $appName, $context = self::Live) {
        $this->setLibRoot($libRoot);
        $this->setApplicationRoot($appRoot);
        $this->setApplicationName($appName);
        $this->setContext($context);
    }

    public static function FromRoot($root, $appName, $context = self::Live) {
        return new self("$root/Jive", "$root/$appName", $context);
    }
}