<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license MIT (see the LICENSE file)
 */
namespace Orno\Config\File;

use Symfony\Component\Yaml\Yaml;

/**
 * Yaml File Loader
 */
class YamlFileLoader extends AbstractFileLoader
{
    /**
     * {@inheritdoc}
     */
    public function parse()
    {
        try {
            $array = (array) Yaml::parse(file_get_contents($this->file));
        } catch (\Exception $e) {
            throw new Exception\ParseException($e->getMessage(), 0, $e);
        }

        return (is_null($this->key)) ? $array : [$this->key => $array];
    }
}
