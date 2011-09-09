<?php
namespace Jive\Persistance\Driver;

use Jive\Persistance;

class FileDriver implements Persistance\IPersistanceDriver {
    const FileExtension = '.jstore.php';

    private $dataLocation;

    public function __construct($dataLocation) {
        $this->dataLocation = $dataLocation;
    }

    public function save(Record $r) {
        $filename = $r->getLocation() . $r->getId() . self::FileExtension;

        return File::Name($this->dataLocation . $filename)->setContents(serialize($r))->write();
    }

    public function complete(Record $r) {
        $filename = $r->getLocation() . $r->getId() . self::FileExtension;

        return unserialize(File::Name($this->dataLocation . $filename)->read()->getContents());
    }

    public function delete(Record $r) {
        $filename = $r->getLocation() . $r->getId() . self::FileExtension;

        return File::Name($this->dataLocation . $filename)->delete();
    }
}