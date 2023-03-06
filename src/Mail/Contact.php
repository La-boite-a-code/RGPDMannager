<?php
namespace Laboiteacode\RGPDManager\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable , SerializesModels;

    public array $content;

    public string $type = 'contact';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $content, $type = 'contact')
    {
        $this->type = $type;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: ['address' => $this->content['email']] ,
            subject: config('app.name') . ' - ' . trans('rgpdmanager::rgpd.mails.' . $this->type),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        $this->content['type'] = $this->type;

        return new Content(
            markdown: 'rgpdmanager::mails.contact' ,
            with: $this->content,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}