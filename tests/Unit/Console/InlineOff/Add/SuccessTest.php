<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 *
 * @copyright 2022 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

namespace Tests\Unit\Console\InlineOff\Add;

use LaravelLang\Publisher\Constants\Locales;
use Tests\Unit\Console\InlineOff\TestCase;

class SuccessTest extends TestCase
{
    protected Locales $locale = Locales::GERMAN;

    public function testDefault(): void
    {
        $this->assertSame('Foo 1', $this->trans('Foo 1'));
        $this->assertSame('Foo 2', $this->trans('Foo 2'));
        $this->assertSame('Foo 3', $this->trans('Foo 3'));

        $this->assertSame('Bar 1', $this->trans('Bar 1'));
        $this->assertSame('Bar 2', $this->trans('Bar 2'));
        $this->assertSame('Bar 3', $this->trans('Bar 3'));

        $this->assertSame('Baq 1', $this->trans('Baq 1'));
        $this->assertSame('Baq 2', $this->trans('Baq 2'));
        $this->assertSame('Baq 3', $this->trans('Baq 3'));

        $this->assertSame('Baw 1', $this->trans('Baw 1'));
        $this->assertSame('Baw 2', $this->trans('Baw 2'));
        $this->assertSame('Baw 3', $this->trans('Baw 3'));

        $this->assertSame('The :attribute must be accepted.', $this->trans('validation.accepted'));
        $this->assertSame('The :attribute must have between :min and :max items.', $this->trans('validation.between.array'));
        $this->assertSame('The :attribute must be between :min and :max kilobytes.', $this->trans('validation.between.file'));
        $this->assertSame('The :attribute field is required.', $this->trans('validation.custom.first_name.required'));
        $this->assertSame('first name', $this->trans('validation.attributes.first_name'));

        $this->assertDirectoryDoesNotExist($this->config->langPath(Locales::GERMAN));

        $this->artisan('lang:add', [
            'locales' => [Locales::GERMAN],
        ])->run();

        $this->assertDirectoryExists($this->config->langPath(Locales::GERMAN));

        $this->assertFileExists($this->config->langPath('de.json'));
        $this->assertFileExists($this->config->langPath(Locales::GERMAN, 'validation.php'));
        $this->assertFileExists($this->config->langPath('vendor/de.json'));

        $this->assertFileDoesNotExist($this->config->langPath('vendor/custom/de.json'));

        $this->assertSame('German Foo 1', $this->trans('Foo 1'));
        $this->assertSame('German Foo 2', $this->trans('Foo 2'));
        $this->assertSame('German Foo 3', $this->trans('Foo 3'));

        $this->assertSame('German Bar 1', $this->trans('Bar 1'));
        $this->assertSame('German Bar 2', $this->trans('Bar 2'));
        $this->assertSame('German Bar 3', $this->trans('Bar 3'));

        $this->assertSame('German Baq 1', $this->trans('Baq 1'));
        $this->assertSame('German Baq 2', $this->trans('Baq 2'));
        $this->assertSame('German Baq 3', $this->trans('Baq 3'));

        $this->assertSame('French Baw 1', $this->trans('Baw 1'));
        $this->assertSame('French Baw 2', $this->trans('Baw 2'));
        $this->assertSame('French Baw 3', $this->trans('Baw 3'));

        $this->assertSame(':Attribute muss akzeptiert werden.', $this->trans('validation.accepted'));
        $this->assertSame(':Attribute muss zwischen :min & :max Elemente haben.', $this->trans('validation.between.array'));
        $this->assertSame(':Attribute muss zwischen :min & :max Kilobytes groß sein.', $this->trans('validation.between.file'));
        $this->assertSame('Dieses Vorname muss ausgefüllt werden.', $this->trans('validation.custom.first_name.required'));
        $this->assertSame('Vorname', $this->trans('validation.attributes.first_name'));
    }

    public function testFallback(): void
    {
        $this->fallback_locale = Locales::FRENCH;

        $this->assertSame('French Foo 1', $this->trans('Foo 1'));
        $this->assertSame('French Foo 2', $this->trans('Foo 2'));
        $this->assertSame('French Foo 3', $this->trans('Foo 3'));

        $this->assertSame('French Bar 1', $this->trans('Bar 1'));
        $this->assertSame('French Bar 2', $this->trans('Bar 2'));
        $this->assertSame('French Bar 3', $this->trans('Bar 3'));

        $this->assertSame('French Baq 1', $this->trans('Baq 1'));
        $this->assertSame('French Baq 2', $this->trans('Baq 2'));
        $this->assertSame('French Baq 3', $this->trans('Baq 3'));

        $this->assertSame('French Baw 1', $this->trans('Baw 1'));
        $this->assertSame('French Baw 2', $this->trans('Baw 2'));
        $this->assertSame('French Baw 3', $this->trans('Baw 3'));

        $this->assertSame('Le champ :attribute doit être accepté.', $this->trans('validation.accepted'));
        $this->assertSame('Le tableau :attribute doit contenir entre :min et :max éléments.', $this->trans('validation.between.array'));
        $this->assertSame('La taille du fichier de :attribute doit être comprise entre :min et :max kilo-octets.', $this->trans('validation.between.file'));
        $this->assertSame('Le champ prénom est obligatoire.', $this->trans('validation.custom.first_name.required'));
        $this->assertSame('prénom', $this->trans('validation.attributes.first_name'));

        $this->assertDirectoryDoesNotExist($this->config->langPath(Locales::GERMAN));

        $this->artisan('lang:add', [
            'locales' => [Locales::GERMAN],
        ])->run();

        $this->assertDirectoryExists($this->config->langPath(Locales::GERMAN));

        $this->assertFileExists($this->config->langPath('de.json'));
        $this->assertFileExists($this->config->langPath(Locales::GERMAN, 'validation.php'));
        $this->assertFileExists($this->config->langPath('vendor/de.json'));

        $this->assertFileDoesNotExist($this->config->langPath('vendor/custom/de.json'));

        $this->assertSame('German Foo 1', $this->trans('Foo 1'));
        $this->assertSame('German Foo 2', $this->trans('Foo 2'));
        $this->assertSame('German Foo 3', $this->trans('Foo 3'));

        $this->assertSame('German Bar 1', $this->trans('Bar 1'));
        $this->assertSame('German Bar 2', $this->trans('Bar 2'));
        $this->assertSame('German Bar 3', $this->trans('Bar 3'));

        $this->assertSame('German Baq 1', $this->trans('Baq 1'));
        $this->assertSame('German Baq 2', $this->trans('Baq 2'));
        $this->assertSame('German Baq 3', $this->trans('Baq 3'));

        $this->assertSame('French Baw 1', $this->trans('Baw 1'));
        $this->assertSame('French Baw 2', $this->trans('Baw 2'));
        $this->assertSame('French Baw 3', $this->trans('Baw 3'));

        $this->assertSame(':Attribute muss akzeptiert werden.', $this->trans('validation.accepted'));
        $this->assertSame(':Attribute muss zwischen :min & :max Elemente haben.', $this->trans('validation.between.array'));
        $this->assertSame(':Attribute muss zwischen :min & :max Kilobytes groß sein.', $this->trans('validation.between.file'));
        $this->assertSame('Dieses Vorname muss ausgefüllt werden.', $this->trans('validation.custom.first_name.required'));
        $this->assertSame('Vorname', $this->trans('validation.attributes.first_name'));
    }
}
