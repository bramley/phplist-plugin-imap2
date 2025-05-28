<?php

namespace phpList\plugin\Imap2;

use Javanile\Imap2\Connection as BaseConnection;
use Javanile\Imap2\Errors;
use Javanile\Imap2\Functions;

class Connection extends BaseConnection
{
    /**
     * Code copied from the parent method to allow setting a debug handler before calling connect().
     */
    public static function open($mailbox, $user, $password, $flags = 0, $retries = 0, $options = [])
    {
        $connection = new Connection($mailbox, $user, $password, $flags, $retries, $options);
        $mailboxParts = Functions::parseMailboxString($mailbox);

        if (in_array('debug', $mailboxParts['path'])) {
            $connection->getClient()->setDebug(
                true,
                function ($client, $message) {
                    \phpList\plugin\Common\debug($message);
                }
            );
        }
        $success = $connection->connect();

        if (empty($success)) {
            Errors::appendErrorCanNotOpen($mailbox, $connection->getLastError());

            trigger_error(Errors::couldNotOpenStream($mailbox, debug_backtrace(), 1), E_USER_WARNING);

            return false;
        }

        return $connection;
    }
}
