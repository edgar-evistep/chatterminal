<?php

namespace App\SlashCommandHandlers;

use Spatie\SlashCommand\Request;
use Spatie\SlashCommand\Response;
use Spatie\SlashCommand\Handlers\SignatureHandler;


class SendEmail extends SignatureHandler
{
    public $signature = "paolo email:send {to} {message} {--queue}";

    public function handle(Request $request): Response
    {
        $to = $this->getArgument('to');

        $message = $this->getArgument('message');

        $queue = $this->getOption('queue') ?? 'default';

        //send email message...
    }
}
