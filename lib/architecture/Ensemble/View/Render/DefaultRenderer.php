<?php

namespace Jive\Ensemble\View\Render;

use Jive\Ensemble\View;

class DefaultRenderer implements View\IRenderable {
    public function render(View\ViewPart $v) {
        $file = $v->getFile();

        if($file->exists()) {
            return $file->parse($this->injection)->getContents();
        } else {
            return false;
        }
    }
}