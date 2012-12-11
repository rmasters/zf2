<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Code
 */

namespace Zend\Code\Reflection\DocBlock\Tag;

/**
 * @category   Zend
 * @package    Zend_Reflection
 */
class LicenseTag implements TagInterface
{
    /**
     * @var string
     */
    protected $url = null;

    /**
     * @var string
     */
    protected $description = null;

    /**
     * @return string
     */
    public function getName()
    {
        return 'license';
    }

    /**
     * @param  string $tagDocBlockLine
     * @return void
     */
    public function initialize($tagDocBlockLine)
    {
        $matches = array();
        preg_match('#(\S+)(?:\s+(.*))?#', $tagDocBlockLine, $matches);

        $this->url = $matches[1];

        if (isset($matches[2])) {
            $this->description = $matches[2];
        }
    }

    /**
     * Get license URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
