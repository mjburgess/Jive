<?php
namespace Jive\Ensemble\View;

use Jive\Http;
use Jive\Data;
use Jive\File;
use ArrayAccess;

class ViewPart {
    const Extension = '.phtml';

    private $injection;
        public function injection() {
            return $this->injection;
        }

    private $template;
        public function getTemplate() {
            return $this->template;
        }

        public function setTemplate($template) {
            $this->template = $template;
        }

    private $directory;
        public function getDirectory() {
            return $this->directory;
        }

        public function setDirectory($directory) {
            $this->directory = $directory;
        }

    private $renderer;
        public function getRenderer() {
            return $this->renderer;
        }

        public function setRenderer(IRenderable $renderer) {
            $this->renderer = $renderer;
        }

    public function __construct($template, $directory, IRenderable $renderer = null) {
        $this->injection = new Data\Store($injection);
        $this->renderer  = $renderer ?: new DefaultRenderer();
        $this->template  = $template;
        $this->directory = $directory;
    }

    public function __call($name, array $args) {
        if(strpos($name, 'set') == 0) {
            $var = lcfirst(str_replace('set', '', $name));
            $this->injection->set($var, $args[0]);

            return $this;
        } elseif(strpos($name, 'get') == 0) {
            $var = lcfirst(str_replace('get', '', $name));

            return $this->injection->get($var);
        } else {
            throw new Exception("View method ($name) not found!");
        }
    }

    public function getFile() {
        return File::Name($this->directory . DIRECTORY_SEPARATOR . $this->template . self::Extension);
    }

    public function render() {
        return $this->renderer->render($this);
    }
}