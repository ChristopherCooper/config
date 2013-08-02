<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */
namespace Orno\Config\File;

/**
 * File Loader Interface
 */
interface FileLoaderInterface
{
    /**
     * Load and parse a configuration file
     *
     * @return array
     */
    public function parse();
}
