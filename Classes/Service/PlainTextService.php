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


use Html2Text\Html2Text;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class PlainTextService implements PlainTextServiceInterface
{

    /**
     * @var Html2Text
     */
    protected $html2Text;

    /**
     * @var array
     */
    protected $settings;

    public function __construct(array $settings = [])
    {
        // $this->html2Text = $html2Text ?? GeneralUtility::makeInstance(Html2Text::class);
    }

    public function injectHtml2Text(Html2Text $html2Text)
    {
        $this->html2Text = $html2Text;
    }

    /**
     * @var ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param ConfigurationManagerInterface $configurationManager
     */
    public function injectConfigurationManager(ConfigurationManagerInterface $configurationManager)
    {
        $this->configurationManager = $configurationManager;
        $this->settings = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'HtmlMailUtility');
    }

    public function initializeObject()
    {
        $config = [];
        if (isset($this->settings['html2Text'])) {
            $config = $this->settings['html2Text'];
        }
    }

    /**
     * @param string $html HTML markup to be converted
     * @return string Plain text version of input markup
     */
    public function convertToPlainText($html)
    {
        $this->html2Text->setHtml($html);
        return $this->html2Text->getText();
    }

    /**
     * @param string $baseUrl
     * @return void
     */
    public function setBaseUrl($baseUrl)
    {
        $this->html2Text->setBaseUrl($baseUrl);
    }
}
