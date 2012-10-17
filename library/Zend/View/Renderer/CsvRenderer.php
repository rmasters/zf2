<?php

namespace Zend\View\Renderer;

use Traversable;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Exception;
use Zend\View\Model\CsvModel;
use Zend\View\Model\ModelInterface as Model;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;

class CsvRenderer implements Renderer, TreeRendererInterface
{
    protected $resolver;

    public function getEngine() {
        return $this;
    }

    public function setResolver(Resolver $resolver) {
        $this->resolver = $resolver;
    }

    public function render($nameOrModel, $values=null) {
        // view models
        if ($nameOrModel instanceof Model) {
            if ($nameOrModel instanceof CsvModel) {
                $values = $nameOrModel->serialize();
            } else {
                throw new Exception\DomainException('Todo - make $nameOrModel a CsvModel');
            }

            return $values;
        }

        // $nameOrModel without $values
        if (is_null($values)) {
            throw new Exception\DomainException('Todo - make $nameOrModel a CsvModel');
        }

        // both
        throw new Exception\DomainException(sprintf('%s: Do not know how to handle operation when both $nameOrModel and $values are populated', __METHOD__));
    }

    public function canRenderTrees() {
        return false;
    }
}
