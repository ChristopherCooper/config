<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */
namespace Orno\Config\File;

/**
 * Abstract File Loader
 */
abstract class AbstractFileLoader
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var string|integer
     */
    protected $key;

    /**
     * Constructor
     *
     * @param string $file
     * @param string $key
     */
    public function __construct($file, $key = null)
    {
        if (! is_readable($file)) {
            throw new Exception\FileNotReadableException(
                sprintf('The file (%s) is either not readable or cannot be found', $file)
            );
        }

        $this->file = $file;
        $this->key  = $key;
    }

    /**
     * Load and parse a configuration file
     *
     * @return array
     */
    abstract public function parse();
}
