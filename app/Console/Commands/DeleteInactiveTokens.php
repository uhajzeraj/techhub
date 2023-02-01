<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

final class DeleteInactiveTokens extends Command
{
    protected $signature = 'techhub:delete-inactive-tokens';

    protected $description = 'Delete inactive tokens';

    public function handle()
    {
        $numberOfTokensDeleted = PersonalAccessToken::query()
            ->where(function ($query) {
                $query->whereNull('last_used_at')
                    ->where('created_at', '<', now()->subMonth());
            })
            ->orWhere(function ($query) {
                $query->whereNotNull('last_used_at')
                    ->where('last_used_at', '<', now()->subMonth());
            })
            ->delete();

        return Command::SUCCESS;
    }
}
