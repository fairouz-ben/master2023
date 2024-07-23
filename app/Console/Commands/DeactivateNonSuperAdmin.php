<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use App\Models\Admin; // Replace with your admin model path

class DeactivateNonSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:non-super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate non-super admin accounts when treatment close date is reached.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $configService = App::make('configuration');

        // Retrieve the date_disable_admin_account value
        $disable_admin_account = $configService->getConfigurationValue('date_disable_admin_account');

        if (!$disable_admin_account) {
            $this->error('date disable admin account configuration parameter not found.');
            return 1; // Indicate failure
        }

        $closeDate = Carbon::parse($disable_admin_account);

        if ($closeDate->isToday()) {
            $this->deactivateNonSuperAdmins();
        } else {
            $this->info('date disable admin account not reached yet.');
        }

        return 0; // Indicate success
    }
   
    

       /**
     * Deactivate non-super admin accounts
     */
    private function deactivateNonSuperAdmins()
    {
        Admin::where('is_active', true)
            ->where('role_id','!=', '1')
            ->update(['is_active' => false]);

        $this->info('Non-super admin accounts deactivated successfully.');
    }
}
