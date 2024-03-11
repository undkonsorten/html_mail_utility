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


namespace Undkonsorten\HtmlMailUtility\ViewHelpers\Css;


use TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\Exception;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\ViewHelperInterface;
use Undkonsorten\HtmlMailUtility\Service\CssInlinerServiceInterface;

class InlineViewHelper extends AbstractViewHelper implements ViewHelperInterface
{

    /**
     * @var CssInlinerServiceInterface
     */
    static protected $cssInlinerService;

    /**
     * @return CssInlinerServiceInterface
     * @throws Exception
     */
    static public function getCssInlinerService()
    {
        if (!isset(static::$cssInlinerService)) {
            static::$cssInlinerService = GeneralUtility::makeInstance(CssInlinerServiceInterface::class);
        }
        return static::$cssInlinerService;
    }

    public function initializeArguments()
    {
        $this->registerArgument('html', 'string', 'HTML markup for inlining');
        $this->registerArgument('css', 'string', 'additional CSS');
        $this->registerArgument('cssFile', 'string', 'CSS file providing additional styles to be inlined');
    }

    public function render()
    {
        return static::renderStatic(
            $this->arguments,
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @throws Exception
     * @throws FileDoesNotExistException
     */
    static public function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    )
    {
        $html = $arguments['html'] ?: $renderChildrenClosure();
        $css = $arguments['css'] ?: '';
        if ($arguments['cssFile']) {
            $filePath = GeneralUtility::getFileAbsFileName(GeneralUtility::fixWindowsFilePath($arguments['cssFile']));
            if (file_exists($filePath)) {
                $css .= file_get_contents($filePath);
            } else {
                throw new FileDoesNotExistException(sprintf('Could not find file %s.', $filePath), 1485643877);
            }
        }
        return static::getCssInlinerService()->inlineCss($html, $css);
    }

}
