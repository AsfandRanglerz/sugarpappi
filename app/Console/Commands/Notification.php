<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Order;
use App\Mail\SendRewardMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with('reward')->where('point', '>=', 150)->get();

        foreach ($users as $user) {
            $reward = $user->point;
            $count = floor($reward / 150);

            if ($count > $user->status) {
                try {
                    Mail::to($user->email)->send(new SendRewardMail($reward));
                    $user->update([
                        'status' => $count,
                    ]);
                } catch (\Exception $e) {
                    // Handle email sending error
                    Log::error('Failed to send reward email to user: ' . $user->id);
                }
            }
        }
        $this->info('Notifications sent successfully.');
        return 0;
    }
}
