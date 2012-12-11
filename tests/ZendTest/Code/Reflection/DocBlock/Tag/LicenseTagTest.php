<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Code
 */

namespace ZendTest\Code\Reflection\DocBlock\Tag;

use Zend\Code\Reflection\DocBlock\Tag\LicenseTag;

/**
 * @category   Zend
 * @package    Zend_Reflection
 * @subpackage UnitTests
 * @group      Zend_Reflection
 * @group      Zend_Reflection_DocBlock
 */
class LicenseTagTest extends \PHPUnit_Framework_TestCase
{
    public function testParseName()
    {
        $tag = new LicenseTag();
        $tag->initialize('http://framework.zend.com/license/new-bsd');
        $this->assertEquals('license', $tag->getName());
        $this->assertEquals('http://framework.zend.com/license/new-bsd', $tag->getUrl());
        $this->assertNull($tag->getDescription());
    }

    public function testParseNameAndDescription()
    {
        $tag = new LicenseTag();
        $tag->initialize('http://framework.zend.com/license/new-bsd New BSD License');
        $this->assertEquals('license', $tag->getName());
        $this->assertEquals('http://framework.zend.com/license/new-bsd', $tag->getUrl());
        $this->assertEquals('New BSD License', $tag->getDescription());
    }
}
