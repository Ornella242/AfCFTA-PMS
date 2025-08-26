<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\TaskArchivationRequest;

class TaskArchiveDeclined extends Mailable
{
    use Queueable, SerializesModels;
    public $archiveRequest;
    public $declineReason;

    /**
     * Create a new message instance.
     */
    public function __construct(TaskArchivationRequest $archiveRequest, $declineReason)
    {
        $this->archiveRequest = $archiveRequest;
        $this->declineReason = $declineReason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Archivation Request Declined',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.tasks.task_archive_declined', 
            with:[
                        'archiveRequest' => $this->archiveRequest,
                        'declineReason' => $this->declineReason,
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
