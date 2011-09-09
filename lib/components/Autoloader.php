<?php
namespace Jive;

class Autoloader {
    private $projectNamespace;
        public function getProjectNamespace() {
            return $this->projectNamespace;
        }
        public function setProjectNamespace($pn) {
            $this->projectNamespace = $pn;
        }

    public function __construct($projectNamespace, $appRoot, $libRoot) {
        $this->setApplicationRoot($appRoot);
        $this->setLibraryRoot($libRoot);
        $this->setProjectNamespace($projectNamespace);
    }

    public function setApplicationRoot($path) {
        $path = $path . '/application/architecture' . PATH_SEPARATOR
              . $path . '/application/components'   . PATH_SEPARATOR
              . $path . '/application/plugins';

        set_include_path(get_include_path() . $path);
    }

    public function setLibraryRoot($path) {
        $path = $path . '/lib/architecture' . PATH_SEPARATOR
              . $path . '/lib/components'   . PATH_SEPARATOR
              . $path . '/lib/plugins';

        set_include_path(get_include_path() . $path);
    }

    public function register() {
        spl_autoload_register(array($this, 'load'));
    }

    public function unregister() {
        spl_autoload_unregister(array($this, 'load'));
    }

    public function load() {
        $namespaceMappings = array(
                         __NAMESPACE__ . '\\'  => '',
        $this->getProjectNamespace()   . '\\'  => '',
                                         '\\'  => DIRECTORY_SEPARATOR,
        );

        $path = str_replace(array_keys($namespaceMappings), array_values($namespaceMappings), "$className.php");

        if(File::Name($path)->exists()) {
            require $path;
        } else {
           throw new AutoloaderException("Class not found $className ($path)");
        }
    }
}