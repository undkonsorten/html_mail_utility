<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::addStaticFile('html_mail_utility', 'Configuration/TypoScript',
    'HTML Mail Utility');
