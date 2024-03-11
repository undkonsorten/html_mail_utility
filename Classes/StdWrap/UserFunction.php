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


namespace Undkonsorten\HtmlMailUtility\StdWrap;


use TYPO3\CMS\Extbase\Object\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use Undkonsorten\HtmlMailUtility\Service\CssInlinerServiceInterface;
use Undkonsorten\HtmlMailUtility\Service\InkyServiceInterface;
use Undkonsorten\HtmlMailUtility\Service\PlainTextServiceInterface;

class UserFunction
{

    /**
     * @var ContentObjectRenderer
     */
    protected $cObj;

    /**
     * @var InkyServiceInterface
     */
    protected $inkyService;

    /**
     * @var PlainTextServiceInterface
     */
    protected $plainTextService;

    public function __construct(
        InkyServiceInterface $inkyService = null,
        PlainTextServiceInterface $plainTextService = null,
        CssInlinerServiceInterface $cssInlinerService = null
    ) {
        $this->inkyService = $inkyService ?? GeneralUtility::makeInstance(InkyServiceInterface::class);
        $this->plainTextService = $plainTextService ?? GeneralUtility::makeInstance(PlainTextServiceInterface::class);
        $this->cssInlinerService = $cssInlinerService ?? GeneralUtility::makeInstance(CssInlinerServiceInterface::class);
    }

    /**
     * @param string $content
     * @param array $configuration
     * @return string
     * @throws Exception
     */
    public function inlineCss(string $content, array $configuration = null): string
    {
        $css = null;
        if (isset($configuration['css']) && isset($configuration['css.'])) {
            $css = $this->cObj->cObjGetSingle($configuration['css'], $configuration['css.']);
        }
        return $this->cssInlinerService->inlineCss($content, $css);
    }

    /**
     * @param $content
     * @param array $configuration
     * @return string
     */
    public function convertToPlainText(
        $content,
        array $configuration = []
    ): string {
        if (isset($configuration['baseUrl'])) {
            $this->plainTextService->setBaseUrl($configuration['baseUrl']);
        }
        return $this->plainTextService->convertToPlainText($content);
    }

    /**
     * @param string $content
     * @param array $configuration
     * @return string
     */
    public function inky(
        $content,
        $configuration = []
    ): string{
        $gridColumns = $configuration['gridColumns'] ?: 12;
        $aliases = $configuration['aliases'] ?: [];
        return $this->inkyService
            ->setGridColumns($gridColumns)
            ->setAliases($aliases)
            ->transform($content);
    }

    public function setContentObjectRenderer(ContentObjectRenderer $cObj): void
    {
        $this->cObj = $cObj;
    }

}
