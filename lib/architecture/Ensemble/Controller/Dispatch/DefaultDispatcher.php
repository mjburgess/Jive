<?php

namespace Jive\Ensemble\Controller\Dispatch;

use Jive\Ensemble\AController;
use Jive\Ensemble\Request;
use Jive\Ensemble\Controller\IDispatchable;

use Jive\Ensemble\View;

class DefaultDispatcher implements IDispatchable {
    const DefaultLayout = 'layout';

    private $layoutName;
        public function getLayoutName() {
            return $this->layoutName;
        }

        public function setLayoutName($layoutName) {
            $this->layoutName = $layoutName;
        }


    public function dispatch(AController $c, Request $r) {
        $method = $r->getAction();

        $httpRequest = new Http\HttpRequest();
        $httpRequest->setRequest($r);

        $httpResponse = new Http\HttpResponse();

        $root = $c->getEnvironment()->getApplicationRoot();
        $view = $this->buildView((string) $c, $root, $c->$method($httpRequest, $httpResponse));

        $httpResponse->setContent($view->render());

        return $httpResponse;
    }

    public function buildView($name, $root, $view) {
        $defaultView = View::FromDefault($name, $this->layoutName ?: self::DefaultLayout, $root);

        if(is_array($view)) {
            $defaultView->parts()->get('main')->injection()->replace($view);
        } elseif($view instanceof ViewPart) {
            $defaultView->parts()->set('main', $view);
        } elseif($view instanceof View) {
            $defaultView = $view;
        }

        return $defaultView;
    }
}