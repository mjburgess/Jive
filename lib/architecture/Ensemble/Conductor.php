<?php

namespace Jive\Ensemble;

use Jive\Application;
use Jive\State;
use Jive\Autoloader;

class Conductor extends AArchitecture {
    private $router;
        public function setRouter(Conductor\IRouter $r) {
            $this->router = $r;
        }
        public function getRouter() {
            return $this->router;
        }

    public function __construct(Conductor\IRouter $r) {
        $this->router = $r;
    }

    public function dispatch(Request $request) {
        $request    = $this->router->route($this->request);
        $controller = $request->getController();

        try {
            $controller = new $controller();

            if(!$controller instanceof AController) {
                throw new Conductor\Exception('Controller must be a Jive\Ensemble\AController');
            }

            return $controler->dispatch($request);
        } catch(Autoloader\Exception $e) {
            throw new Conductor\Exception('Controller not found!');
        }
    }
}