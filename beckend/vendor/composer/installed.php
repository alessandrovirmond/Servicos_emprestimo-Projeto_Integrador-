<?php return array(
    'root' => array(
        'name' => 'acme/beckend',
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'reference' => NULL,
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'acme/beckend' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'reference' => NULL,
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'kahlan/kahlan' => array(
            'pretty_version' => '5.2.5',
            'version' => '5.2.5.0',
            'reference' => 'b306b275316c35c96da931fb619387e82eb61760',
            'type' => 'library',
            'install_path' => __DIR__ . '/../kahlan/kahlan',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
        'phpstan/phpstan' => array(
            'pretty_version' => '1.10.39',
            'version' => '1.10.39.0',
            'reference' => 'd9dedb0413f678b4d03cbc2279a48f91592c97c4',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpstan/phpstan',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
    ),
);