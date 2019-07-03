<?php

namespace InetStudio\ContestsPackage\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:contests-package:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup contests package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Contests setup',
                'command' => 'inetstudio:contests-package:contests:setup',
            ],
        ];
    }
}
