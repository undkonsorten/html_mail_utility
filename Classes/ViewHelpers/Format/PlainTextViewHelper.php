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


namespace Undkonsorten\HtmlMailUtility\ViewHelpers\Format;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\ViewHelperInterface;
use Undkonsorten\HtmlMailUtility\Service\PlainTextServiceInterface;

class PlainTextViewHelper extends AbstractViewHelper implements ViewHelperInterface
{

    /**
     * @var PlainTextServiceInterface
     */
    static protected $plainTextService;

    /**
     * @return PlainTextServiceInterface
     */
    static public function getPlainTextService()
    {
        if (!isset(static::$plainTextService)) {
            static::$plainTextService = GeneralUtility::makeInstance(PlainTextServiceInterface::class);
        }
        return static::$plainTextService;
    }


    public function initializeArguments()
    {
        $this->registerArgument('html', 'string', 'HTML markup for inlining');
        $this->registerArgument('baseUrl', 'string', 'Base URL for relative links');
    }

    public function render()
    {
        return static::renderStatic(
            $this->arguments,
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    static public function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    )
    {
        $html = $arguments['html'] ?: $renderChildrenClosure();
        $plainTextService = static::getPlainTextService();
        if (isset($arguments['baseUrl'])) {
            $plainTextService->setBaseUrl($arguments['baseUrl']);
        }
        return $plainTextService->convertToPlainText($html);
    }

}
