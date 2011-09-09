<?php

namespace Jive\Http;

use Jive\Data;
use Exception;

class HttpResponse {
    private $headers;
        public function headers() {
            return $this->headers;
        }

        public function setHeaders(Data\Store $headers) {
            $this->headers = $headers;
        }

    private $content;
        public function getContent() {
            return $this->content;
        }

        public function setContent($content) {
            $this->content = $content;
        }

    private $exception;
        public function getException() {
            return $this->exception;
        }

        public function setException(Exception $exception) {
            $this->exception = $exception;
        }

    private $writeException = true;
        public function getWriteException() {
            return $this->writeException;
        }

        public function setWriteException($writeException) {
            $this->writeException = $writeException;
        }

    public function __construct() {
        $this->headers = new Data\Store();
    }

    public function writeHeaders() {
        foreach($this->headers as $header => $value) {
            header("$header: $value");
        }
    }

    public function __toString() {
        return $this->getContent() . ($this->writeException ? $this->getException() : '');
    }
}