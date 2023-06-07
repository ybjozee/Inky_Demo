<?php

namespace App\Message;

final class NotifyRecipients {

    public function __construct(
        private readonly string $content,
        private readonly array  $recipients
    ) {
    }

    public function getContent()
    : string {

        return $this->content;
    }

    public function getRecipients()
    : array {

        return $this->recipients;
    }

}
