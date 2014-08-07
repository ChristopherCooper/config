# Orno\Config

[![Latest Version](http://img.shields.io/packagist/v/orno/config.svg?style=flat)](https://packagist.org/packages/orno/config)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/orno/config/master.svg?style=flat)](https://travis-ci.org/orno/config)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/orno/config.svg?style=flat)](https://scrutinizer-ci.com/g/orno/config/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/orno/config.svg?style=flat)](https://scrutinizer-ci.com/g/orno/config)
[![Total Downloads](https://img.shields.io/packagist/dt/orno/config.svg?style=flat)](https://packagist.org/packages/orno/config)

A package designed to DRY up the setting and retrieving of config items.

## Usage

### Basic

The simplest usage would be setting and retrieving config items.

    <?php

    $config = new Orno\Config\Repository;

    // standard
    $config->set('key', 'value');
    $key = $config->get('key');

    // set a default value to be used if the key does not exist
    $anotherKey = $config->get('another-key', 'default value');

### Config Files

Orno\Config can parse **PHP Array Config Files**, **YAML Config Files**, **INI Config Files**, **JSON Config Files** and **XML Config Files**. When using a file loader, an optional parent key can be provided to store the contents of the config file.

#### PHP Array

    <?php

    return [
        'database' => 'PDO',
        'username' => 'username'
        'password' => 'p4ssw0rd'
    ];

The above file could be parsed and accessed in the following way with a parent key provided.

    <?php

    // with parent key
    $loader = new \Orno\Config\File\ArrayFileLoader('path/to/config/file.php', 'db');
    $config = (new \Orno\Config\Repository)->addFileLoader($loader);

    // now the config array is available in the config object
    echo $config['db']['database']; // PDO
    echo $config['db']['username']; // username
    echo $config['db']['password']; // p4ssw0rd

#### YAML

    db:
        database: PDO
        username: username
        password: p4ssw0rd

The above file could be parsed and accessed in the following way without a parent key as it is already provided in the config file.

    <?php

    // no parent key
    $loader = new \Orno\Config\File\YamlFileLoader('path/to/config/file.yml');
    $config = (new \Orno\Config\Repository)->addFileLoader($loader);

    // now the config array is available in the config object
    echo $config['db']['database']; // PDO
    echo $config['db']['username']; // username
    echo $config['db']['password']; // p4ssw0rd

#### INI

    [db]
    db[database] = "PDO"
    db[username] = "username"
    db[password] = "p4ssw0rd"

To parse/access.

    <?php

    // no parent key
    $loader = new \Orno\Config\File\IniFileLoader('path/to/config/file.ini');
    $config = (new \Orno\Config\Repository)->addFileLoader($loader);

    // now the config array is available in the config object
    echo $config['db']['database']; // PDO
    echo $config['db']['username']; // username
    echo $config['db']['password']; // p4ssw0rd

#### JSON

    {
        database: "PDO",
        username: "username",
        password: "p4ssw0rd"
    }

To parse/access.

    <?php

    // with parent key
    $loader = new \Orno\Config\File\JsonFileLoader('path/to/config/file.json', 'db');
    $config = (new \Orno\Config\Repository)->addFileLoader($loader);

    // now the config array is available in the config object
    echo $config['db']['database']; // PDO
    echo $config['db']['username']; // username
    echo $config['db']['password']; // p4ssw0rd

#### XML

    <?xml version="1.0" standalone="yes"?>
    <config>
        <db>
            <database>PDO</database>
            <username>username</username>
            <password>p4ssw0rd</password>
        </db>
    </config>

Not that the top level element in your XML file must be `config`.

To parse/access.

    <?php

    // no parent key
    $loader = new \Orno\Config\File\XmlFileLoader('path/to/config/file.xml');
    $config = (new \Orno\Config\Repository)->addFileLoader($loader);

    // now the config array is available in the config object
    echo $config['db']['database']; // PDO
    echo $config['db']['username']; // username
    echo $config['db']['password']; // p4ssw0rd


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/orno/config/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

