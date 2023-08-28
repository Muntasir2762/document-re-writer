<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class UpdateUserBlockStatus extends Command
{
    protected $signature = 'app:update-block-status';
    protected $description = 'Update is_blocked status for users based on limit_updated_at timestamp';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::where('limit_updated_at', '<=', Carbon::now()->subMinutes(20))
        ->where('is_blocked', true)->get();

        foreach ($users as $user) {
            $user->is_blocked = false;
            $user->limit_count = 0;
            $user->save();
        }

        $this->info('User block status updated successfully.');
    }
}
