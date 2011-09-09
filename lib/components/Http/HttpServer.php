<?php
namespace Jive\Http;

class HttpServer {
    private $server;
        public function state() {
            return $this->server;
        }

   public function __construct(array $server = null) {
       $this->server = new Data\Store($server ?: $_SERVER);
   }
}