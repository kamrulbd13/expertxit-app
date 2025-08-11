<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer, $course, $systemInfo, $certificateInfo;

    public function __construct($customer, $course, $systemInfo, $certificateInfo)
    {
        $this->customer             = $customer;
        $this->course               = $course;
        $this->systemInfo           = $systemInfo;
        $this->certificateInfo      = $certificateInfo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Certificate Has Been Issued Successfully.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $mailData = [
            'name'                      => $this->customer->name,
            'training_name'             => $this->course->training_name,
            'site_name'                 => $this->systemInfo->site_name,
            'copy_right'                => $this->systemInfo->copy_right,
            'mail2'                     => $this->systemInfo->mail2,
            'website_link'              => $this->systemInfo->website_link,
            'certificate_issue_date'    => $this->certificateInfo->certificate_issue_date,
        ];

        return new Content(
            view: 'emails.certificate_issued',
            with: ['mailData' => $mailData], // ✅ Fixed syntax: changed `with :[` to `with: [`
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
