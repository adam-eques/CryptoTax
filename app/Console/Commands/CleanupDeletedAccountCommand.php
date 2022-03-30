<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupDeletedAccountCommand extends Command
{
    protected $signature = 'crypto:accounts:cleanup';
    protected $description = 'Command description';


    public function handle()
    {
        // Delete all crypto_accounts, without an user
        \DB::unprepared("
            DELETE FROM crypto_accounts WHERE id IN (
                SELECT a.id
                FROM `crypto_accounts` AS a
                LEFT JOIN users AS b ON b.id = a.user_id
                WHERE b.id IS NULL
            )
        ");

        // Delete all crypto_assets, without a crypto_account
        \DB::unprepared("
              DELETE FROM crypto_assets WHERE id IN (
                SELECT a.id
                FROM `crypto_assets` AS a
                LEFT JOIN crypto_accounts as b ON b.id = a.crypto_account_id
                WHERE b.id IS NULL
            )
        ");

        // Delete transactions, without a crypto_account
        \DB::unprepared("
              DELETE FROM crypto_transactions WHERE id IN (
                SELECT a.id
                FROM `crypto_transactions` AS a
                LEFT JOIN crypto_accounts as b ON b.id = a.crypto_account_id
                WHERE b.id IS NULL
            )
        ");
    }
}
