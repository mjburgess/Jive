<?php
namespace Jive\Ensemble\Conductor;

use Jive\Ensemble\Request;

interface IRouter {
    public function route(Request $r);
}