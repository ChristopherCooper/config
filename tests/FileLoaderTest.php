<?php

namespace OrnoTest;

use Orno\Config\File\ArrayFileLoader;
use Orno\Config\File\YamlFileLoader;
use Orno\Config\File\JsonFileLoader;
use Orno\Config\File\IniFileLoader;
use Orno\Config\File\XmlFileLoader;

class FileLoaderTest extends \PHPUnit_Framework_Testcase
{
    public function testParsesArrayFileWithoutKey()
    {
        $loader = new ArrayFileLoader(__DIR__ . '/assets/array-file.php');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'key1' => 'value1',
                'key2' => 'value2'
            ]
        );
    }

    public function testParsesArrayFileWithKey()
    {
        $loader = new ArrayFileLoader(__DIR__ . '/assets/array-file.php', 'some-parent-key');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'some-parent-key' => [
                    'key1' => 'value1',
                    'key2' => 'value2'
                ]
            ]
        );
    }

    public function testArrayFileLoaderThrowsExceptionWhenFileNotReadable()
    {
        $this->setExpectedException('Orno\Config\File\Exception\FileNotReadableException');

        $loader = new ArrayFileLoader(__DIR__ . '/assets/unreadable-array-file.php');
    }

    public function testArrayFileLoaderThrowsExceptionWhenProvidedMalformedFile()
    {
        $this->setExpectedException('Orno\Config\File\Exception\ParseException');

        $loader = new ArrayFileLoader(__DIR__ . '/assets/array-file-malformed.php');
        $array = $loader->parse();
    }

    public function testParsesYamlFileWithoutKey()
    {
        $loader = new YamlFileLoader(__DIR__ . '/assets/yaml-file.yml');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'SomeKey' => [
                    'SomeChildKey' => [
                        'key1' => 'value1',
                        'key2' => 'value2'
                    ]
                ]
            ]
        );
    }

    public function testParsesYamlFileWithKey()
    {
        $loader = new YamlFileLoader(__DIR__ . '/assets/yaml-file.yml', 'some-parent-key');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'some-parent-key' => [
                    'SomeKey' => [
                        'SomeChildKey' => [
                            'key1' => 'value1',
                            'key2' => 'value2'
                        ]
                    ]
                ]
            ]
        );
    }

    public function testYamlFileLoaderThrowsExceptionWithMalformedFile()
    {
        $this->setExpectedException('Orno\Config\File\Exception\ParseException');

        $loader = new YamlFileLoader(__DIR__ . '/assets/yaml-file-malformed.yml');
        $array = $loader->parse();
    }

    public function testParsesJsonFileWithoutKey()
    {
        $loader = new JsonFileLoader(__DIR__ . '/assets/json-file.json');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'SomeKey' => [
                    'SomeChildKey' => [
                        'key1' => 'value1',
                        'key2' => 'value2'
                    ]
                ]
            ]
        );
    }

    public function testParsesJsonFileWithKey()
    {
        $loader = new JsonFileLoader(__DIR__ . '/assets/json-file.json', 'some-parent-key');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'some-parent-key' => [
                    'SomeKey' => [
                        'SomeChildKey' => [
                            'key1' => 'value1',
                            'key2' => 'value2'
                        ]
                    ]
                ]
            ]
        );
    }

    public function testJsonFileLoaderThrowsExceptionWithMalformedFile()
    {
        $this->setExpectedException('Orno\Config\File\Exception\ParseException');

        $loader = new JsonFileLoader(__DIR__ . '/assets/json-file-malformed.json');
        $array = $loader->parse();
    }

    public function testParsesIniFileWithoutKey()
    {
        $loader = new IniFileLoader(__DIR__ . '/assets/ini-file.ini');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'SomeKey' => [
                    'SomeChildKey' => [
                        'key1' => 'value1',
                        'key2' => 'value2'
                    ]
                ]
            ]
        );
    }

    public function testParsesIniFileWithKey()
    {
        $loader = new IniFileLoader(__DIR__ . '/assets/ini-file.ini', 'some-parent-key');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'some-parent-key' => [
                    'SomeKey' => [
                        'SomeChildKey' => [
                            'key1' => 'value1',
                            'key2' => 'value2'
                        ]
                    ]
                ]
            ]
        );
    }

    public function testIniFileLoaderThrowsExceptionWithMalformedFile()
    {
        $this->setExpectedException('Orno\Config\File\Exception\ParseException');

        $loader = new IniFileLoader(__DIR__ . '/assets/ini-file-malformed.ini');
        $array = $loader->parse();
    }

    public function testParsesXmlFileWithoutKey()
    {
        $loader = new XmlFileLoader(__DIR__ . '/assets/xml-file.xml');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'SomeKey' => [
                    'SomeChildKey' => [
                        'key1' => 'value1',
                        'key2' => 'value2'
                    ]
                ]
            ]
        );
    }

    public function testParsesXmlFileWithKey()
    {
        $loader = new XmlFileLoader(__DIR__ . '/assets/xml-file.xml', 'some-parent-key');
        $array = $loader->parse();

        $this->assertInternalType('array', $array);
        $this->assertSame(
            $array,
            [
                'some-parent-key' => [
                    'SomeKey' => [
                        'SomeChildKey' => [
                            'key1' => 'value1',
                            'key2' => 'value2'
                        ]
                    ]
                ]
            ]
        );
    }

    public function testXmlFileLoaderThrowsExceptionWithMalformedFile()
    {
        $this->setExpectedException('Orno\Config\File\Exception\ParseException');

        $loader = new XmlFileLoader(__DIR__ . '/assets/xml-file-malformed.xml');
        $array = $loader->parse();
    }
}
