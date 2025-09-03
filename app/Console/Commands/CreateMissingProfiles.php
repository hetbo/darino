<?php

namespace App\Console\Commands;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Console\Command;

class CreateMissingProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profiles:create-missing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Back-fill Profiles Table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to create missing user profiles...');

        $usersWithoutProfiles = User::whereDoesntHave('profile')->get();

        if ($usersWithoutProfiles->isEmpty()) {
            $this->info('All users already have a profile. No action needed.');
            return self::SUCCESS;
        }

        $this->info("Found {$usersWithoutProfiles->count()} users without a profile. Creating now...");

        $progressBar = $this->output->createProgressBar($usersWithoutProfiles->count());
        $progressBar->start();

        foreach ($usersWithoutProfiles as $user) {

            Profile::create([
                'user_id' => $user->id,
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->info('Successfully created profiles for all missing users.');

        return self::SUCCESS;

    }
}
