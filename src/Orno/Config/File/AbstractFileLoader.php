<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license MIT (see the LICENSE file)
 */
namespace Orno\Config\File;

/**
 * Abstract File Loader
 */
abstract class AbstractFileLoader implements FileLoaderInterface
{
    /**
     * The path to the config
     *
     * @var string
     */
    protected $file;

    /**
     * The key in which our parsed config file should be stored
     *
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
     * {@inheritdoc}
     */
    abstract public function parse();
}
