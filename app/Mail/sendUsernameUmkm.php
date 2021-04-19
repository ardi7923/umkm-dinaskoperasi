<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendUsernameUmkm extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $employee_name = $this->data['employee_name'];
        $document_number = $this->data['document_number'];
        return $this->to($this->data['email'])
                    ->subject("Peringatan Batas Waktu Peminjaman Dokumen")
                    ->view('mails.warning',compact('employee_name','document_number'));
    }
}
