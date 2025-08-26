<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectDeletionRequestMail extends Mailable
{
    use Queueable, SerializesModels;
    public $project, $reason, $requester;

    /**
     * Create a new message instance.
     */
    public function __construct($project, $reason, $requester)
    {
        $this->project = $project;
        $this->reason = $reason;
        $this->requester = $requester;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Cancellation Request Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
        view: 'emails.project_deletion_request',
        with: [
            'project' => $this->project,
            'reason' => $this->reason,
            'requester' => $this->requester,
        ],
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
