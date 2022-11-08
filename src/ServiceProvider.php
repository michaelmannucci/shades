<?php

namespace Michaelmannucci\Shades;

use Michaelmannucci\Shades\Modifiers\Shades;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $modifiers = [
        Shades::class,
    ];
}