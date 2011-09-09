<?php
namespace Jive\Ensamble;

use Jive\Http;
use Jive\Application;

abstract class AController extends Application\AArchitecture {
    private $dispatcher;
        public function getDispatcher() {
            return $this->dispatcher;
        }

        public function setDispatcher(Controller\IDispatchable $dispatcher) {
            $this->dispatcher = $dispatcher;
        }

    public function dispatch(Request $r) {
        $dispatcher = $this->dispatcher ?: new Controller\Dispatch\DefaultDispatcher();

        return $dispatcher->dispatch($this, $r);
    }

    public function __call($name, array $args) {
        throw new Exception("Contoller method ($name) on $this not found!");
    }

    public function __toString() {
        return basename(str_replace('\\', '/', get_class($this)));
    }
}