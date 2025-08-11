<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Attachment;

class PaymentVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $course;
    public $systemInfo;
    public $pdfPath;

    public function __construct($customer, $course, $systemInfo, $pdfPath)
    {
        $this->customer     = $customer;
        $this->course       = $course;
        $this->systemInfo   = $systemInfo;
        $this->pdfPath      = $pdfPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Payment Has Been Successfully Verified',
        );
    }

    public function content(): Content
    {
        $customerData = [
            'name'              => $this->customer->name,
            'training_name'     => $this->course->training_name,
            'site_name'         => $this->systemInfo->site_name,
            'copy_right'        => $this->systemInfo->copy_right,
            'mail2'             => $this->systemInfo->mail2,
            'website_link'      => $this->systemInfo->website_link,
        ];

        return new Content(
            view: 'emails.payment_verified',
            with: [
                'customerData' => $customerData
    ],
        );
    }

//    for pdf
//    public function attachments(): array
//    {
//        return [
//            Attachment::fromPath($this->pdfPath)
//                ->as('invoice.pdf')
//                ->withMime('application/pdf'),
//        ];
//    }
}
