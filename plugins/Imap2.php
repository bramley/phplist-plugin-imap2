<?php

/**
 * Imap2 plugin for phplist.
 *
 * This file is a part of Imap2 plugin.
 *
 * This plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @category  phplist
 *
 * @author    Duncan Cameron
 * @copyright 2023 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */
class Imap2 extends phplistPlugin
{
    const VERSION_FILE = 'version.txt';

    /*
     *  Inherited variables
     */
    public $name = 'IMAP Emulation';
    public $authors = 'Duncan Cameron';
    public $description = 'Uses the javanile/php-imap2 package to emulate the php imap_* functions';
    public $enabled = 1;

    public function __construct()
    {
        $this->coderoot = dirname(__FILE__) . '/' . __CLASS__ . '/';

        parent::__construct();

        $this->version = (is_file($f = $this->coderoot . self::VERSION_FILE))
            ? file_get_contents($f)
            : '';
        require $this->coderoot . 'imap_functions.php';
    }

    /**
     * Provide the dependencies for enabling this plugin.
     *
     * @return array
     */
    public function dependencyCheck()
    {
        global $allplugins, $plugins;

        return [
            'Common plugin must be enabled' => array_key_exists('CommonPlugin', $plugins),
            'IMAP plugin must not be installed' => !array_key_exists('ImapPlugin', $allplugins),
            'php version 8' => version_compare(PHP_VERSION, '8') > 0,
        ];
    }

    public function activate()
    {
        global $bounce_mailbox_port;

        parent::activate();

        if (isset($bounce_mailbox_port)) {
            $bounce_mailbox_port = str_replace(['110', '995', 'pop3'], ['143', '993', 'imap'], $bounce_mailbox_port);
        }
    }

    public function adminmenu()
    {
        return [];
    }
}
