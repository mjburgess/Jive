<?php
namespace Jive\Data;

use ArrayAccess, Serializable, Countable, IteratorAggregate;

/**
 * ArrayObject with a better API / added features
 */
class Store implements ArrayAccess, Serializable, Countable, IteratorAggregate {
    private $store;
        public function add($data) {
            $this->store[] = $data;
        }
        public function set($key, $data) {
            $this->store[$key] = $data;
        }
        public function replace(array $store) {
            $this->store = $store;
        }
        public function merge(array $new) {
            $this->store = array_merge($$this->store, $new);
        }
        public function sort() {
            sort($this->store);
        }
        public function get($key) {
            return $this->store[$key];
        }

        public function lookup($property, $value) {
            $method = "get$property";

            foreach($this->store as $item) {
                //empty returns true for private/protected properties
                if(!empty($item->property)) {
                    return $item->$property;
                } elseif(method_exists($item, $method) || method_exists($item, '__call') && $item->$method() == $item) {
                    return $item;
                }
            }

            return null;
        }

        public function has($key) {
            return isset($store[$key]);
        }
        public function delete($key) {
            unset($this->store[$key]);
        }
        public function clear() {
            unset($this->store);
        }

    public function __construct(array $data = array()) {
        $this->store = $data;
        $this->access = $access;
    }

    //Implement Array Interfaces: ArrayAccess,
    public function offsetSet($key, $value) {
        if (empty($key)) {
            $this->store[] = $value;
        } else {
            $this->store[$key] = $value;
        }
    }

    public function offsetExists($key) {
        return isset($this->store[$key]);
    }

    public function offsetUnset($key) {
        unset($this->store[$key]);
    }

    public function offsetGet($key) {
        return isset($this->store[$key]) ? $this->store[$key] : null;
    }

    public function serialize() {
        return serialize($this->store);
    }
    public function unserialize($data) {
        $this->store = unserialize($data);
    }

    public function count() {
        return count($this->store);
    }

    public function getIterator() {
        return new ArrayIterator($this->store);
    }
}