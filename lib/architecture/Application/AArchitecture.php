<?php

namespace Jive\Application;

abstract class AArchitecture {
    private static $environment;
        public function getEnvironment() {
            return self::$environment;
        }

        public function setEnvironment(Environment $environment) {
            self::$environment = $environment;
        }
}