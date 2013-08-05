<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license MIT (see the LICENSE file)
 */
namespace Orno\Config\File;

/**
 * INI File Loader
 */
class IniFileLoader extends AbstractFileLoader
{
    /**
     * {@inheritdoc}
     */
    public function parse()
    {
        if ($array = parse_ini_file($this->file, true)) {
            return (is_null($this->key)) ? $array : [$this->key => $array];
        }

        throw new Exception\ParseException(
            sprintf('The file (%s) has syntax errors', $this->file)
        );
    }
}
