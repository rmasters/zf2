<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Code
 */

namespace ZendTest\Code\Generator\DocBlock\Tag;

use Zend\Code\Generator\DocBlock\Tag\LicenseTag;
use Zend\Code\Reflection\DocBlock\Tag\LicenseTag as ReflectionLicenseTag;

/**
 * @category   Zend
 * @package    Zend_Code_Generator
 * @subpackage UnitTests
 *
 * @group Zend_Code_Generator
 * @group Zend_Code_Generator_Php
 */
class LicenseTagTest extends \PHPUnit_Framework_TestCase
{
    /** @var Tag */
    protected $tag;

    /** @var string */
    protected $licenseUrl;

    /** @var string */
    protected $licenseName;

    public function setUp()
    {
        $this->tag = new LicenseTag();

        $this->licenseUrl = 'http://framework.zend.com/license/new-bsd';
        $this->licenseName = 'New BSD License';
    }

    public function tearDown()
    {
        $this->tag = null;
    }

    public function testUrlGetterAndSetterPersistValue()
    {
        $this->tag->setUrl($this->licenseUrl);
        $this->assertEquals($this->licenseUrl, $this->tag->getUrl());
    }

    public function testDescriptionGetterAndSetterPersistValue()
    {
        $this->tag->setDescription($this->licenseName);
        $this->assertEquals($this->licenseName, $this->tag->getDescription());
    }

    public function testLicenseProducesCorrectDocBlockLine()
    {
        $this->tag = new LicenseTag;
        $this->tag->setUrl($this->licenseUrl);
        $this->tag->setDescription($this->licenseName);
        $this->assertEquals('@license http://framework.zend.com/license/new-bsd New BSD License', $this->tag->generate());
    }

    public function testLicenseProducesCorrectDocBlockLineUrlOnly()
    {
        $this->tag = new LicenseTag;
        $this->tag->setUrl($this->licenseUrl);
        $this->assertEquals('@license http://framework.zend.com/license/new-bsd', $this->tag->generate());
    }

    public function testLicenseFromReflectionDocBlockTag()
    {
        $reflectionLicense = new ReflectionLicenseTag;
        $reflectionLicense->initialize('http://framework.zend.com/license/new-bsd');

        $this->tag = LicenseTag::fromReflection($reflectionLicense);
        $this->assertEquals('license', $this->tag->getName());
        $this->assertEquals('http://framework.zend.com/license/new-bsd', $this->tag->getUrl());
        $this->assertNull($this->tag->getDescription());
    }
}
