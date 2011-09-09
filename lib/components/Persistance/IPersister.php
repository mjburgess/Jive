<?php
namespace Jive\Persistance;

interface IPersister {
    public function save($object);
    public function delete($object);
    public function complete($object);
}