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

use function Pinky\transformString;
class PinkyService implements InkyServiceInterface
{

    public function initializeObject()
    {
    }

    /**
     * @param string $html Markup to be transformed
     * @return string The transformed markup
     */
    public function transform($html)
    {
        return transformString($html)->saveHTML();
    }

    /**
     * @param int $gridColumns
     * @return $this
     */
    public function setGridColumns($gridColumns)
    {
        return $this;
    }

    /**
     * @param array $aliases
     * @return $this
     */
    public function setAliases(array $aliases = [])
    {
        return $this;
    }

}