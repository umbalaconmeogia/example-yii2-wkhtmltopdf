<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'test',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 0 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'trace'],
                ],
            ],
        ],
        'db' => $db,
		'htmlToPdf' => [
			'class' => 'boundstate\htmlconverter\HtmlToPdfConverter',
// 			'bin' => '@app/bin/wkhtmltopdf/wkhtmltopdf',
		    'bin' => 'G:\data\projects.it\openSource\example-yii2-wkhtmltopdf\src\example-yii2-wkhtmltopdf\bin\wkhtmltopdf\wkhtmltopdf',
			// global wkhtmltopdf command line options
			// (see http://wkhtmltopdf.org/usage/wkhtmltopdf.txt)
			'options' => [
				'print-media-type',
				'disable-smart-shrinking',
				'no-outline',
				'page-size' => 'A4',
				'load-error-handling' => 'ignore',
				'load-media-error-handling' => 'ignore'
			],
		],
		'response' => [
			'formatters' => [
				'pdf' => [
					'class' => 'boundstate\htmlconverter\PdfResponseFormatter',
					// Set a filename to download the response as an attachments (instead of displaying in browser)
					'filename' => 'attachment.pdf'
				],
			]
		],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
