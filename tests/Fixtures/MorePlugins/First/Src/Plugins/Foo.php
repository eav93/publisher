<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2022 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

namespace Tests\Fixtures\MorePlugins\First\Src\Plugins;

use LaravelLang\Publisher\Plugins\Plugin;

class Foo extends Plugin
{
    public function files(): array
    {
        return [];
    }
}
