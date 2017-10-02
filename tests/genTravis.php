<?php

$travisData = [
    'language'      => 'php',
    'matrix'        => [
        'include' => [],
    ],
    'before_script' => [
        'travis_retry composer self-update',
        implode(' ', [
            'if [ "$PUG_VERSION" != "" ];',
            'then travis_retry composer require "pug-php/pug:${PUG_VERSION}" --no-update;',
            'fi;',
        ]),
        'travis_retry composer update --no-interaction',
    ],
    'script'        => [
        'vendor/bin/phpunit --verbose --coverage-text --coverage-clover=coverage.xml',
    ],
    'after_script'  => [
        'vendor/bin/test-reporter --coverage-report coverage.xml',
    ],
    'after_success' => [
        'bash <(curl -s https://codecov.io/bash)',
    ],
    'addons'        => [
        'code_climate' => [
            'repo_token' => '42424e464a16a1cd50ed98cf9dc112e78f53a443566a26f2b3f7a86d3386d4cd',
        ],
    ],
];

$matrix = [
    '5.3'  => ['2.7.1'],
    '5.4'  => ['2.7.1'],
    '5.5'  => ['2.7.1', '3.0.0-alpha3@alpha'],
    '5.6'  => ['2.7.1', '3.0.0-alpha3@alpha'],
    '7.0'  => ['2.7.1', '3.0.0-alpha3@alpha'],
    '7.1'  => ['2.7.1', '3.0.0-alpha3@alpha'],
    '7.2'  => ['2.7.1', '3.0.0-alpha3@alpha'],
    'hhvm' => ['2.7.1', '3.0.0-alpha3@alpha'],
];

foreach ($matrix as $phpVersion => $pugVersions) {
    foreach ($pugVersions as $pugVersion) {
        $environment = [
            'php' => $phpVersion,
            'env' => "PUG_VERSION='$pugVersion'",
        ];
        if (in_array($phpVersion, ['hhvm', '5.3'])) {
            $environment['dist'] = 'trusty';
            $environment['sudo'] = 'required';
        }
        $travisData['matrix']['include'][] = $environment;
    }
}

function compileYaml($data, $indent = 0)
{
    $contents = '';
    foreach ($data as $key => $value) {
        $isAssoc = is_string($key);
        $contents .= str_repeat(' ', $indent * 2) . ($isAssoc ? $key . ':' : '-');
        if (is_array($value)) {
            $value = compileYaml($value, $indent + 1);
            $contents .= $isAssoc
                ? "\n$value"
                : ' ' . ltrim($value);

            continue;
        }

        $contents .= ' ' . $value . "\n";
    }

    return $contents;
}

file_put_contents(__DIR__ . '/../.travis.yml', compileYaml($travisData));
