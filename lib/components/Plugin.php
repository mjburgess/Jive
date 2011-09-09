<?php

interface IObserver {
    public function notify($message, array $messageArguments);
}

interface ISubject {
    public function registerObserver(IObserver $o);
    public function notifyObservers($message, array $messageArguments);
}

abstract class AObserver implements IObserver {
    public function notify($message, array $messageArguments) {
        $this->$message($messageArguments);
    }
}

abstract class ASubject implements ISubject {
    private $observers;
        public function registerObserver(IObserver $o) {
            $this->observers[] = $o;
        }

    public function __call($method, array $arguments = array()) {
        $method =  'on' . ucfirst($method);

        if(!method_exists($this, $method)) {
            return;
        }

        call_user_func_array(array($this, $method), $arguments);
        $this->notifyObservers($method, $arguments);
    }

    public function notifyObservers($message, array $messageArguments) {
        if(!is_array($this->observers)) {
            return;
        }

        foreach($this->observers as $observer) {
            $observer->notify($message, $messageArguments);
        }
    }
}


class Observed extends ASubject {
    public function onApi() {
        echo 'Hello';
    }
}

class Observer extends AObserver {
    public function onApi() {
        echo ' World!';
    }
}

$o = new Observed();
$o->registerObserver(new Observer());

$o->api();


