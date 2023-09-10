<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Commands\ImapIdleCommand;
use Webklex\PHPIMAP\Message;

class CustomImapIdleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom_command';

    /**  
     * Holds the account information
     *     
     * @var string|array $account  
     */
    protected $account = "default";

    /**  
     * Callback used for the idle command and triggered for every new received message
     * @param Message $message  
     */
    public function onNewMessage(Message $message)
    {
        $this->info("New message received: " . $message->subject);
    }
}
