<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Models\Subscriber;
use App\Models\Newsletter;
use App\Mail\CornMail;


class NewsletterCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:sent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command use for Newsletter Cron Hit';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Cron Job running at " . now());
    
        // Fetch records where 'in_future' date matches today's date
        $subscribers = Subscriber::where('status', 1)
        ->where('updated_at', '<', now())
        ->where('mail_send_status', '=', 0)
        ->get();
    
    // Check if any subscribers are fetched before proceeding
    if ($subscribers->isNotEmpty()) {
        foreach ($subscribers as $subscriber) {
            $email = $subscriber->email;
            if (Mail::to($email)->send(new CornMail($subscriber))) {
                // Email sent successfully
                $subscriber->mail_send_status = 1;
                $subscriber->updated_at = date('Y-m-d H:i:s');
                $subscriber->update();
            } else {
                // Log the failure
                \Log::error('Failed to send email to: ' . $email);
            }
        }
    }
    else{
        \Log::error('No Data Found to sent:');
    }
}
    
    
}
