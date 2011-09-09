<?php

namespace Jive\Ensemble;

use Jive\Data;

class View {
    private $layout;
        public function getLayout() {
            return $this->layout;
        }

        public function setLayout(View\ViewPart $layout) {
            $this->layout = $layout;
        }

    private $parts;
        public function parts() {
            return $this->parts;
        }
        public function setMainPart(View\ViewPart $v) {
            $this->parts->set('main', $v);
        }
        public function getMainPart() {
            return $this->parts->get('main');
        }

    public function __construct() {
        $this->parts = new Data\Store();
    }

    public static function FromDefault($mainName, $layoutName, $root) {
        $view     = new self();

        $view->setMainPart(new View\ViewPart($mainName, $root));
        $view->setLayout(new View\ViewPart($layoutName, $root));

        return $view;
    }

    public function render() {
        $output = '';
        foreach($this->parts as $part) {
            $output .= $part->render();
        }

        if($this->layout) {
            $this->layout->setContent($output);
            $output = $this->layout->render();
        }

        return $output;
    }
}