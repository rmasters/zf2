<?php

namespace Zend\Mvc\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Strategy\CsvStrategy;

class ViewCsvStrategyFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $csvRenderer = $serviceLocator->get('ViewCsvRenderer');
        $csvStrategy = new CsvStrategy($csvRenderer);
        return $csvStrategy;
    }
}
