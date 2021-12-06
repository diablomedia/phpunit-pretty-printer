<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->notPath('tests/phpt')
    ->files()
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();
return $config->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        '@PHP70Migration' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        '@PHPUnit60Migration:risky' => true,
        'binary_operator_spaces' => ['align_double_arrow' => true, 'align_equals' => true],
        'binary_operator_spaces' => array(
            'default'   => 'align_single_space_minimal',
            'operators' => array('||' => null, '&&' => null)
        ),
        'single_quote' => false,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'dir_constant' => true,
        'no_mixed_echo_print' => ['use' => 'echo'],
        'no_unused_imports' => true,
        'declare_strict_types' => false
    ])
    ->setUsingCache(true)
    ->setFinder($finder);
;
