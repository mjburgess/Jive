<?php

namespace Jive\Http;

class HttpRequest {
    private $applicationRequest;
        public function request() {
            return $this->applicationRequest;
        }
        public function setRequest($request) {
            $this->applicationRequest = $request;
        }

    private $get;
        public function query() {
            return $this->get;
        }
        public function setQuery(Data\Store $q) {
            $this->get = $q;
        }
    private $post;
        public function post() {
            return $this->post;
        }
        public function setPost(Data\Store $post) {
            $this->post = $post;
        }
    private $cookie;
        public function cookie() {
            return $this->cookie;
        }
        public function setCookie(Data\Store $cookie) {
            $this->cookie = $cookie;
        }

    public function __construct(array $get = null, array $post = null, array $cookie = null) {
        $this->get    = new Data\Store($get    ?: $_GET);
        $this->post   = new Data\Store($post   ?: $_POST);
        $this->cookie = new Data\Store($cookie ?: $_COOKIE);
    }
}