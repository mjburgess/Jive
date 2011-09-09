<?php

namespace Jive\Ensemble\Controller;

use Jive\Ensemble\AController;
use Jive\Ensemble\Request;

interface IDispatchable {
    public function dispatch(AController $c, Request $r);
}