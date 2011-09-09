<?php
namespace Jive\Persistance;

interface IPersistable {
    public function persist();
    public function find($id);
    public function delete($id);
    public function getMapper();
}