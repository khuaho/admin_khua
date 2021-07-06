<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;


class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $user;
    public $file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $user, $file)
    {
        $this->data = $data;
        $this->user = $user;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user)->send(new MailNotify($this->data,$this->file));
    }
}
