<?php

namespace App\Jobs;

use App\Mail\PostMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PostMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public array $data;
    public array $emails;

    public function __construct(array $data, array $emails)
    {
        $this->data = $data;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->emails['users'] as $mail) {
            Mail::to($mail)
            ->send(new PostMail($this->data));
        }
    }
}
