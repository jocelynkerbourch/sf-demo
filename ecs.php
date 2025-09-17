<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSets([
        SetList::CLEAN_CODE,
        SetList::SYMPLIFY,
        SetList::PSR_12,
    ])
    ->withSkip([
        // skip specific files or rules if needed
    ]);