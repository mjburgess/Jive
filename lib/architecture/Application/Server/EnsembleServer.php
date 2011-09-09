<?php

namespace Jive\Application\Server;

use Jive\Ensamble;
use Jive\Application;
use Jive\Http\HttpServer;

class EnsembleServer implements Application\IServeable {
    private $conductor;
        public function setConductor(Ensemble\Conductor $c) {
            $this->conductor = $c;
        }

    private $server;
        public function setServer(Http\HttpServer $s) {
            $this->server = $s;
        }
        public function getServer() {
            return $this->server;
        }

    private $request;
        public function getRequest() {
            return $this->request;
        }

        public function setRequest($request) {
            $this->request = $request;
        }

    private $response;
        public function getResponse() {
            return $this->response;
        }

        public function setResponse($response) {
            $this->response = $response;
        }

    public function __construct(Http\HttpServer $s = null) {
        $this->server = $s ?: new Http\HttpServer();
    }

    public function serve($request = null) {
        $this->request  = $request ?: new Request($this->server->get('REQUEST_URI'));
        
        try {
            $this->response =  $this->conductor->dispatch($this->request);
        } catch(\Exception $e) {
            $this->response->setException($e);
        }

        return $this->response;
    }
}