<?php

namespace Jive\Ensemble\View\Render;

use Jive\Ensemble\View;

class XmlElement extends \SimpleXMLElement {
    public function addChild($value, $name) {
        parent::addChild($name, $value);
    }
}

class FlatXmlRenderer implements View\IRenderable {
    public function render(View\ViewPart $v) {
        $xml = new XmlElement("<{$v->getTemplate()}/>");

        array_walk_recursive($v->injection(), array($xml, 'addChild'));

        return $xml->asXML();
    }
}