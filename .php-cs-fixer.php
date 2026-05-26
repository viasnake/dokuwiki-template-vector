<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->name('*.php')
    ->name('*.php.dist');

return (new PhpCsFixer\Config())
    ->setRules(array(
        '@PSR12' => true,
    ))
    ->setFinder($finder);
