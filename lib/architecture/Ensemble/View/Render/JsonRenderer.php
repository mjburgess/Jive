<?php

namespace Jive\Ensemble\View\Render;

use Jive\Ensemble\View;

class JsonRenderer implements View\IRenderable {
    public function render(View\ViewPart $v) {
        return json_encode($v->injection());
    }
}