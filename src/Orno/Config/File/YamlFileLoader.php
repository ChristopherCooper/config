<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
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
            $array = (array) Yaml::parse($this->file);
        } catch (\Exception $e) {
            throw new Exception\ParseException($e->getMessage(), 0, $e);
        }

        return (is_null($this->key)) ? $array : [$this->key => $array];
    }
}
