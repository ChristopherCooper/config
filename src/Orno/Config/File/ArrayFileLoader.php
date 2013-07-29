<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */
namespace Orno\Config\File;

/**
 * Array File Loader
 */
class ArrayFileLoader extends AbstractFileLoader
{
    /**
     * {@inheritdoc}
     */
    public function parse()
    {
        $array = include $this->file;

        if (! is_array($array)) {
            throw new Exception\ParseException(
                sprintf('The file (%s) must return a PHP array', $this->file)
            );
        }

        return (is_null($this->key)) ? $array : [$this->key => $array];
    }
}
