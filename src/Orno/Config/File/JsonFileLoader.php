<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license MIT (see the LICENSE file)
 */
namespace Orno\Config\File;

/**
 * Json File Loader
 */
class JsonFileLoader extends AbstractFileLoader
{
    /**
     * {@inheritdoc}
     */
    public function parse()
    {
        $array = json_decode(file_get_contents($this->file), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception\ParseException(
                sprintf('The file (%s) must contain a valid JSON string', $this->file)
            );
        }

        return (is_null($this->key)) ? $array : [$this->key => $array];
    }
}
