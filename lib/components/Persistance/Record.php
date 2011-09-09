<?php
namespace Jive\Persistance;

use Jive\Data;

class Record implements ISaveable {
    private $location;
        public function getLocation() {
            return $this->location;
        }

        public function setLocation($location) {
            $this->location = $location;
        }

    private $id;
        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

    private $data;
        public function data() {
            return $this->data;
        }

        public function setData(Data\Store $data) {
            $this->data = $data;
        }

    public function __construct($id, $location = null, Data\Store $d = null) {
        $this->id = $id;
        $this->location = $location;
        $this->data = $d ?: new Data\Store();
    }

    public function serialize() {
        return serialize($this->data);
    }

    public function unserialize($serialized) {
        $this->data = unserialize($serialized);
    }
}