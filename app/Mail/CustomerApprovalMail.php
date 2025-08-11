<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $systemInfo;
    public function __construct($data, $systemInfo)
    {
        $this->data         = $data;
        $this->systemInfo   = $systemInfo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: ' Registration Has Been Approved',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $mailData = [
            'name'              => $this->data->name,
            'site_name'         => $this->systemInfo->site_name,
            'copy_right'        => $this->systemInfo->copy_right,
            'mail2'             => $this->systemInfo->mail2,
            'website_link'      => $this->systemInfo->website_link,
        ];

       return new Content(
            view: 'emails.customer_approval',
            with:[
               'mailData' => $mailData,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
