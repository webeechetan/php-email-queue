<?php

namespace EmailQueue;

class SendEmailJob extends Job
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function handle()
    {
        // Send email logic here
        mail(
            implode(',', $this->email['recipients']),
            $this->email['subject'],
            $this->email['body'],
            implode("\r\n", $this->email['headers'])
        );
    }
}
