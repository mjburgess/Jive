<?php
namespace Jive\Persistance;

interface IPersistanceDriver {
    public function save(Record $r);
    public function delete(Record $r);
    public function complete(Record $r);
}