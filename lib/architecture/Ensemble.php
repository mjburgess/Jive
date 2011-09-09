<?php

namespace Jive;

class Ensemble extends Application\AArchitecture {
    public static function FromDefault($root, $appName) {
        $this->setEnvironment(Application\Environment::FromRoot($root, $appName));

        $server  = new Http\HttpServer();
        $request = new Request($server->state()->get('REQUEST_URI'));

        $application = new Application();
        $application->autoload();
    }
}