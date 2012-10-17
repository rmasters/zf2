<?php

namespace Zend\Mvc\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\CsvRenderer;

class ViewCsvRendererFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $csvRenderer = new CsvRenderer();
        return $csvRenderer;
    }
}
