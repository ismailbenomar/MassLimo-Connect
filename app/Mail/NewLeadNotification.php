<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewLeadNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->lead->request_type === 'reservation'
            ? 'New MassLimo Connect reservation request'
            : 'New MassLimo Connect callback request');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.new-lead');
    }
}
