<?php

namespace OrnoTest;

use Orno\Config\Repository as Config;

class RepositoryTest extends \PHPUnit_Framework_Testcase
{
    protected $loaders = [];

    public function setUp()
    {
        $loader1 = $this->getMock('Orno\Config\File\FileLoaderInterface');

        $loader1->expects($this->any())
                ->method('parse')
                ->will($this->returnValue($this->getArray()[0]));

        $loader2 = $this->getMock('Orno\Config\File\FileLoaderInterface');

        $loader2->expects($this->any())
                ->method('parse')
                ->will($this->returnValue($this->getArray()[1]));

        $loader3 = $this->getMock('Orno\Config\File\FileLoaderInterface');

        $loader3->expects($this->any())
                ->method('parse')
                ->will($this->returnValue($this->getArray()[2]));

        $this->loaders[] = $loader1;
        $this->loaders[] = $loader2;
        $this->loaders[] = $loader3;
    }

    public function tearDown()
    {
        $this->loaders = [];
    }

    public function getArray()
    {
        return [
            [
                'config1' => [
                    'some-key' => 'some value',
                    'another-key' => 'another value',
                    'integer' => 888
                ]
            ],
            [
                'config2' => [
                    'some-key' => 'some value',
                    'another-key' => 'another value',
                    'integer' => 888
                ]
            ],
            [
                'config3' => [
                    'some-key' => 'some value',
                    'another-key' => 'another value',
                    'integer' => 888
                ]
            ]
        ];
    }

    public function testConstructorParsesLoaders()
    {
        $c = new Config($this->loaders);

        $this->assertSame($c['config1'], $this->getArray()[0]['config1']);
        $this->assertSame($c['config2'], $this->getArray()[1]['config2']);
        $this->assertSame($c['config3'], $this->getArray()[2]['config3']);
    }

    public function testSetsAndUnsetsValue()
    {
        $c = new Config;

        $c['test'] = 'some value';

        $this->assertTrue(isset($c['test']));
        $this->assertSame($c['test'], 'some value');

        unset($c['test']);

        $this->assertFalse(isset($c['test']));
    }

    public function testReturnsDefaultValueWhenUnsetAndRealValueWhenSet()
    {
        $c = new Config;

        $this->assertSame($c->get('test', 'default-value'), 'default-value');
        $c->set('test', 'real-value');
        $this->assertSame($c->get('test', 'default-value'), 'real-value');

    }

    public function testExceptionIsThrownWhenTryingToAccessUndefinedKey()
    {
        $this->setExpectedException('Orno\Config\Exception\UndefinedOffsetException');

        $c = new Config;

        $c->get('test');
    }
}
