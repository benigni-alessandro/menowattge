<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The data.
     *
     * @var array
     */
    public $filename;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filename, $datamessage)
    {
        $this->filename = $filename;
        $this->data = $datamessage;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notification')
            ->subject('ciao')
            ->attach($this->filename);
    }
}