<?php

namespace App\MessageHandler;

use App\Message\NotifyRecipients;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Twig\Environment;

#[AsMessageHandler(fromTransport: 'async')]
final class NotifyRecipientsHandler {

    private Address $sender;

    public function __construct(
        private readonly Environment     $twig,
        private readonly MailerInterface $mailer,
        string                           $senderEmail,
        string                           $senderName
    ) {

        $this->sender = new Address($senderEmail, $senderName);
    }

    public function __invoke(
        NotifyRecipients $message
    ) {

        $paragraphs = preg_split("/\r\n|\n|\r/", $message->getContent());
        $htmlContent = $this->twig->render('email/inky.html.twig', ['paragraphs' => $paragraphs]);
        $recipients = $message->getRecipients();
        foreach ($recipients as $recipient) {
            $email = (new Email())
                ->from($this->sender)
                ->to($recipient)
                ->subject('With love from Inky ❤️')
                ->html($htmlContent);
            $this->mailer->send($email);
        }
    }
}
