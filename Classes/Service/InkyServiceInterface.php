<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 19.01.17
 * Time: 13:57
 */

namespace Undkonsorten\HtmlMailUtility\Service;


interface InkyServiceInterface
{

    /**
     * @param string $html
     * @return string
     */
    public function transform($html);

    /**
     * @param int $gridColumns
     * @return $this
     */
    public function setGridColumns($gridColumns);

    /**
     * @param array $aliases
     * @return $this
     */
    public function setAliases(array $aliases = []);

}