<?php

namespace Jive\Application;

interface IServeable {
    public function serve($request = null);
}