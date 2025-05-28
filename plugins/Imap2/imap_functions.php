<?php

if (!function_exists('imap2_open')) {
    function imap2_open($mailbox, $user, $password, $flags = 0, $retries = 0, $options = [])
    {
        if (IMAP2_RETROFIT_MODE && !($flags & OP_XOAUTH2)) {
            return imap_open($mailbox, $user, $password, $flags, $retries, $options);
        }

        return phpList\plugin\Imap2\Connection::open($mailbox, $user, $password, $flags, $retries, $options);
    }
}
