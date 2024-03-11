<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 18.01.17
 * Time: 22:12
 */

namespace Undkonsorten\HtmlMailUtility\Service;


interface CssInlinerServiceInterface
{

    /**
     * @param string $html HTML markup of the mail body
     * @param string $css Optional CSS styles
     * @return string HTML markup with css rules inlined
     */
    public function inlineCss($html, $css = null);

}