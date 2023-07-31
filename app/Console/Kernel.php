<?php

namespace App\Console;

use App\Mail\NewBlogPostsMail;
use App\Models\Post;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $today = now()->format('Y-m-d');
            $newBlogPosts = Post::whereDate('created_at', $today)->get();

            if ($newBlogPosts->isNotEmpty()) {
                Mail::to('recipient@example.com')->send(new NewBlogPostsMail($newBlogPosts));
            }
        })->dailyAt('18:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
