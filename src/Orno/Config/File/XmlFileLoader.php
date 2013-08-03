<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */
namespace Orno\Config\File;

/**
 * XML File Loader
 */
class XmlFileLoader extends AbstractFileLoader
{
    /**
     * Callback to achieve recursion in array walk of SimpleXMLElement objects as
     * child elements fail is_object calls when iterated over
     *
     * @var \Closure
     */
    protected $callback;

    /**
     * {@inheritdoc}
     */
    public function parse()
    {
        try {
            $array = (array) new \SimpleXMLElement(file_get_contents($this->file));

            $this->callback = function (&$value) {
                $value = (is_object($value)) ? (array) $value : $value;

                if (is_array($value)) {
                    array_walk($value, $this->callback);
                }
            };

            array_walk($array, $this->callback);
        } catch (\Exception $e) {
            throw new Exception\ParseException(
                sprintf('File (%s) could not be parsed as XML', $this->file), 0, $e
            );
        }

        return (is_null($this->key)) ? $array : [$this->key => $array];
    }
}
