<?php

namespace App\Console\Commands;

use App\Models\LabAccessCredential;
use Illuminate\Console\Command;

class UpdateLabAccessStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-lab-access-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update lab access status based on expiry date';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Fetch credentials where the expiry_date is less than or equal to now
        $credentials = LabAccessCredential::where('expiry_date', '<=', now())->get();

        if ($credentials->isEmpty()) {
            $this->info('No expired lab access credentials found.');
        } else {
            foreach ($credentials as $credential) {
                // Set status to 0 if the lab access has expired
                $credential->status = 0;
                $credential->save();
            }

            $this->info('Lab Access status updated successfully!');
        }
    }
}
