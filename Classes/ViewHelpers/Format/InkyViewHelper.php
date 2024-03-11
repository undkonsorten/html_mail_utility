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
use Undkonsorten\HtmlMailUtility\Service\InkyServiceInterface;

class InkyViewHelper extends AbstractViewHelper implements ViewHelperInterface
{

    /**
     * @var InkyServiceInterface
     */
    static protected $inkyService;

    static public function getInkyService()
    {
        if (!isset(static::$inkyService)) {
            static::$inkyService = GeneralUtility::makeInstance(InkyServiceInterface::class);
        }
        return static::$inkyService;
    }

    public function initializeArguments()
    {
        $this->registerArgument('markup', 'string', 'Inky markup that will be transformed to stone-age HTML');
        $this->registerArgument('gridColumns', 'int', 'Column count to use for grid calculations', false, 12);
        $this->registerArgument('aliases', 'array', 'Aliases for tagnames. Array keys go for aliases and array values for aliases tag names.', false, []);
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
        $markup = $arguments['markup'] ?: $renderChildrenClosure();
        $inkyService = static::getInkyService()
            ->setGridColumns($arguments['gridColumns'])
            ->setAliases($arguments['aliases']);
        return $inkyService->transform($markup);
    }

}
