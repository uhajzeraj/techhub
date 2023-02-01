<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class DeleteInactiveTokens extends Command
{
    protected $signature = 'techhub:delete-inactive-tokens';

    protected $description = 'Delete inactive tokens';

    public function handle()
    {
        return Command::SUCCESS;
    }
}
