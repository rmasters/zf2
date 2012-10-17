<?php

namespace Zend\View\Strategy;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Http\Request as HttpRequest;
use Zend\View\Model;
use Zend\View\Renderer\CsvRenderer;
use Zend\View\ViewEvent;

class CsvStrategy implements \Zend\EventManager\ListenerAggregateInterface
{
    protected $listeners = [];
    protected $renderer;

    public function __construct(CsvRenderer $renderer) {
        $this->renderer = $renderer;
    }

    public function attach(EventManagerInterface $events, $priority=1) {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }

    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function selectRenderer(ViewEvent $e) {
        $model = $e->getModel();

        $request = $e->getRequest();
        if (!$request instanceof HttpRequest) {
            return $model instanceof Model\CsvModel ? $this->renderer : null;
        }

        $headers = $request->getHeaders();
        if (!$headers->has('Accept')) {
            return $model instanceof Model\CsvModel ? $this->renderer : null;
        }

        $accept = $headers->get('Accept');
        if (($match = $accept->match('text/csv')) == false) {
            return $model instanceof Model\CsvModel ? $this->renderer : null;
        }

        if ($match->getTypeString() == 'text/csv') {
            return $this->renderer;
        }

        return $model instanceof Model\CsvModel ? $this->renderer : null;
    }

    public function injectResponse(ViewEvent $e) {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) return;

        $result = $e->getResult();
        if (!is_string($result)) return;

        $response = $e->getResponse();
        $response->setContent($result);
        $headers = $response->getHeaders()->addHeaderLine('content-type', 'text/csv');
    }
}
