<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * ©2017 Felix Althaus <felix.althaus@undkonsorten.com>
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */


namespace Undkonsorten\HtmlMailUtility\Service;


use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CssInlinerService implements CssInlinerServiceInterface
{

    /**
     * @var CssToInlineStyles
     */
    protected $cssToInlineStyles;

    public function __construct(CssToInlineStyles $cssToInlineStyles = null)
    {
        if ($cssToInlineStyles === null) {
            $cssToInlineStyles = GeneralUtility::makeInstance(CssToInlineStyles::class);
        }
        $this->cssToInlineStyles = $cssToInlineStyles;
    }

    /**
     * @param string $html HTML markup of the mail body
     * @param string $css Optional CSS styles
     * @return string HTML markup with css rules inlined
     */
    public function inlineCss($html, $css = null): string
    {
        return $this->cssToInlineStyles->convert($html, $css);
    }
}
