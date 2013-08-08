<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license MIT (see the LICENSE file)
 */
namespace Orno\Config;

/**
 * Config Repository
 */
class Repository implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * Constructor
     *
     * Accepts an array of file loaders to be parsed and stored in the repository
     *
     * @param array $loaders
     */
    public function __construct(array $loaders = [])
    {
        foreach ($loaders as $loader) {
            $this->parseFileLoader($loader);
        }
    }

    /**
     * Return a key from the config repository, provide a default to be returned
     * if the key does not exist
     *
     * @param  mixed $key
     * @param  mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (! isset($this->config[$key]) && is_null($default)) {
            throw new Exception\UndefinedOffsetException(
                sprintf('Undefined offset: %s in config repository and no default provided', $key)
            );
        }

        return (isset($this->config[$key])) ? $this->config[$key] : $default;
    }

    /**
     * Set a key in the config repository and assign a value to it, be aware that
     * this method will override any pre existing key of the same name
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return \Orno\Config\Repository
     */
    public function set($key, $value)
    {
        $this->config[$key] = $value;

        return $this;
    }

    /**
     * Accepts an implementation of a file loader and parses the output to be
     * stored in the config repository
     *
     * @param  \Orno\Config\File\FileLoaderInterface $loader
     * @return \Orno\Config\Repository
     */
    public function addFileLoader(File\FileLoaderInterface $loader)
    {
        $this->config = array_merge($this->config, $loder->parse());

        return $this;
    }

    /**
     * ArrayAccess Get method
     *
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * ArrayAccess Set method
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * ArrayAccess Exists method
     *
     * @param  mixed $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->config[$offset]);
    }

    /**
     * ArrayAccess Unset method
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->config[$offset]);
    }
}
