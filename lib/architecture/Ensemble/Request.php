<?php
namespace Jive\Ensemble;

class Request {
    private $module;
        public function getModule() {
            return $this->module;
        }
        public function setModule($m) {
            $this->module = $m;
        }

    private $controller;
        public function getController() {
            return $this->controller;
        }
        public function setController($c) {
            $this->controller = $c;
        }

    private $action;
        public function setAction($a) {
            $this->action = $a;
        }
        public function getAction() {
            return $this->action;
        }

    private $parameters;
        public function setParameters(Data\Store $data) {
            $this->parameters = $data;
        }
        public function getParameters() {
            return $this->parameters;
        }

    private $requestString;
        public function getRequestString() {
            return $this->requestString;
        }
        public function setRequestString($requestString) {
            $this->requestString = $requestString;
        }

    public function __construct($request) {
        if(is_string($request)) {
            $this->requestString = $request;
        } elseif(is_array($request)) {
            list($this->module, $this->controller, $this->action, ) = $request;
        }
    }

    public function __toString() {
        return $this->requestString;
    }
}