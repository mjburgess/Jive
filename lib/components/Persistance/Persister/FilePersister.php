<?php
namespace Jive\Persistance\Persister;

use Jive\Persistance;

class FilePersister implements IPersister {
    private $driver;

    public function __construct($dataLocation) {
        $this->driver = new Persistance\Driver\FileDriver($dataLocation);
    }

    public function complete(Persistance\IPersistable $object) {
        $mapper = $object->getMapper();
        foreach($mapper->getRecords() as $record) {
            $this->driver->complete($record);
        }
    }

    public function delete(Persistance\IPersistable $object) {
        $mapper = $object->getMapper();
        foreach($mapper->getRecords() as $record) {
            $this->driver->delete($record);
        }
    }

    public function save(Persistance\IPersistable $object) {
        $mapper = $object->getMapper();
        foreach($mapper->getRecords() as $record) {
            $this->driver->save($record);
        }
    }
}