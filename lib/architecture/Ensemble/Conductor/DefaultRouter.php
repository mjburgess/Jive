<?php

namespace Jive\Ensemble\Conductor;

use Jive\Ensemble\Request;

class DefaultRouter {
    private $defaultRequest;
        public function setDefaultRequest(Request $r) {
            $this->defaultRequest = $r;
        }
        public function getDefaultRequest() {
            return $this->defaultRequest;
        }

    private $separator;
        public function getSeparator() {
            return $this->separator;
        }
        public function setSeparator($sep) {
            $this->separator = $sep;
        }

    public function __construct(Request $defaultRequest = null, $separator = '/') {
        $this->setDefaultRequest($r ?: new Request(array('Main', 'Main', 'index')));
        $this->setSeparator($separator);
    }

    public function route(Request $r) {
        $requestParts = explode($this->getSeparator(), $r->getRequestString());

        $r->setModule($this->getModule($requestParts));
        $r->setController($this->getController($requestParts));
        $r->setAction($this->getAction($requestParts));
        $r->setParameters($this->getParameters($requestParts));

        return $r;
    }

    private function getModule(array &$parts) {
        $module = array_pop($parts);

        return $module ?: $this->defaultRequest->getModule();
    }

    private function getController(array &$parts) {
        $controller = array_pop($parts);

        return $controller ?: $this->defaultRequest->getController();
    }

    private function getAction(array &$parts) {
        $action = array_pop($parts);

        return $action ?: $this->defaultRequest->getAction();
    }

    private function getParameters(array $parts) {
        $data = array();

        $numParts = count($parts);
        for($i = 0; $i < $numParts; $data[$parts[$i++]] = $parts[$i++]);

        return $parts;
    }
}