<?php
namespace Jive\Persistance;

use Serializable;

interface ISaveable extends Serializable {
    public function getLocation();
    public function getData();
}