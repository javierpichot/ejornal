<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Upload extends Mailable
{
    use Queueable, SerializesModels;

    protected $attach;
    protected $title;
    protected $empresa;
    protected $content;
    protected $de;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attach, $subject, $empresa, $content, $de)
    {
        $this->attach  = $attach;
        $this->title = $subject;
        $this->empresa = $empresa;
        $this->content = $content;
        $this->de = $de;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $empresa = $this->empresa;
        $content = $this->content;
        $message = $this->view('emails.info_attach_empresa', compact('empresa', 'from', 'content'));
        $message->subject($this->title);
        $message->from($this->de);

        foreach ($this->attach as $file) {
            $message->attach($file['file'], $file['options']);
        }

        return $message;
    }
}
