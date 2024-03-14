<?php

/** @noinspection PhpUndefinedVariableInspection */
$EM_CONF[$_EXTKEY] = [
	'title' => 'HTML Mail Utility',
	'description' => 'Mail Utility: css inlining and plaintext',
	'category' => 'services',
	'author' => 'Felix Althaus',
	'author_email' => 'felix.althaus@undkonsorten.com',
	'state' => 'beta',
	'version' => '1.0.0',
	'constraints' => [
		'depends' => [
			'typo3' => '11.5.0 - 0.0.0',
        ],
		'conflicts' => [
        ],
		'suggests' => [
        ],
    ],
    'autoload' => [
        'psr-4' => ['Undkonsorten\\HtmlMailUtility\\' => 'Classes'],
    ]

];
