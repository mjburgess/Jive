<?php
namespace Jive\Persistance;

use Jive\Data;

class APersistable implements IPersistable {
    private $ensurePersistance = true;
        public function getEnsurePersistance() {
            return $this->ensurePersistance;
        }

        public function setEnsurePersistance($ensurePersistance) {
            $this->ensurePersistance = $ensurePersistance;
        }

    private $persister;
        public function getPersister() {
            return $this->persister;
        }

        public function setPersister(IPersistable $persister) {
            $this->persister = $persister;
        }

    private $mapper;
        public function getMapper() {
            return $this->mapper ?: new Mapper\DefaultMapper($this);
        }

        public function setMapper($mapper) {
            $this->mapper = $mapper;
        }

    public function persist() {
        $this->persister->save($this->record);
    }

    public function delete() {
        $this->persister->delete($this->record);
    }

    public function find() {
        $this->persister->complete($this->record);
    }

    public function __destruct() {
        if($this->ensurePersistance()) {
            $this->persist();
        }
    }
}