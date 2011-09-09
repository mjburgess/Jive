<?php
namespace Jive\Persistance\Mapper;
use Jive\Persistance;

class DefaultMapper implements Persistance\IMapper {
    private $record;
        public function getRecords() {
            return $this->record;
        }
        
    public function __construct(Persistance\IPersistable $p) {
        $r = new ReflectionClass($p);
        $this->record = new Persistance\Record();

        foreach($r->getProperties() as $property) {
            if(strpos($property->getDocComment(), '@persist')) {
                $this->record->data()->set($property->getName(), $property->getValue());
            }
        }
    }
}