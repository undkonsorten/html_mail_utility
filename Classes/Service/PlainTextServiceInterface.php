<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 18.01.17
 * Time: 22:21
 */

namespace Undkonsorten\HtmlMailUtility\Service;

interface PlainTextServiceInterface
{

    /**
     * @param string $html HTML markup to be converted
     * @return string Plain text version of input markup
     */
    public function convertToPlainText($html);

    /**
     * @param string $baseUrl
     * @return void
     */
    public function setBaseUrl($baseUrl);

}