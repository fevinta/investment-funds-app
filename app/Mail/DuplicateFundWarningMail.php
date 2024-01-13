<?php

namespace App\Mail;

use App\Models\Fund;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DuplicateFundWarningMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Fund $fund, public Collection $duplicates)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Duplicate Fund Warning',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.funds.duplicate-warning',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
