<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

namespace Tests\Unit\Console\Decorated;

use LaravelLang\Publisher\Constants\Locales;
use Tests\Unit\Console\InlineOff\TestCase;

class EnabledDecorateTest extends TestCase
{
    protected Locales $fallback_locale = Locales::ENGLISH;

    protected bool $smart_punctuation = true;

    public function testDecorator(): void
    {
        $this->forceDeleteLocale(Locales::ENGLISH);

        $this->copyFixtures();

        $this->assertSame('All rights', $this->trans('All rights reserved.'));
        $this->assertSame('Forbidden', $this->trans('Forbidden'));
        $this->assertSame('Go to page', $this->trans('Go to page :page'));
        $this->assertSame('Hello!', $this->trans('Hello!'));

        $this->assertSame('"It\'s super-configurable... you can even use additional extensions to expand its capabilities -- just like this one!"', $this->trans('Printed'));

        $this->artisanLangUpdate();

        $this->assertSame('All rights reserved.', $this->trans('All rights reserved.'));
        $this->assertSame('Forbidden', $this->trans('Forbidden'));
        $this->assertSame('Go to page', $this->trans('Go to page :page'));
        $this->assertSame('Hello!', $this->trans('Hello!'));

        $this->assertSame('“It’s super-configurable… you can even use additional extensions to expand its capabilities – just like this one!”', $this->trans('Printed'));
    }

    public function testRussian(): void
    {
        $this->setAppLocale(Locales::RUSSIAN);

        $this->copyFixtures();

        $this->assertSame(
            "\"Вишь ты, -- сказал один другому, -- вон какое колесо!\nчто ты думаешь, доедет то колесо, если б случилось, в Москву или не\nдоедет?\"",
            $this->trans('Text')
        );

        $this->artisanLangUpdate();

        $this->assertSame(
            "«Вишь ты, – сказал один другому, – вон какое колесо!\nчто ты думаешь, доедет то колесо, если б случилось, в Москву или не\nдоедет?»",
            $this->trans('Text')
        );
    }
}
