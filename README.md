# Imap2 Plugin #

## Description ##

This plugin uses the javanile/php-imap2 package to emulate the php imap_xxx functions that are used by phplist for bounce processing.
Some hosting providers, such as GoDaddy shared hosting, do not provide the imap extension that is needed by the phplist bounce processing.

If your php configuration already includes the imap extension then you do not need this plugin.

## Installation ##

Install on the Plugins page (menu Config > Plugins) using the package URL `https://github.com/bramley/phplist-plugin-imap2/archive/master.zip`.

## Usage ##

For guidance on using the plugin see the plugin's page within the phplist documentation site <https://resources.phplist.com/plugin/imap2>

## Support ##

Please raise any questions or problems in the user forum <https://discuss.phplist.org/>.

## Version history ##

    version         Description
    1.0.2+20250122  Allow plugin to be a dependency of phplist. Fixes #4
    1.0.1+20230204  Revised dependency checks
    1.0.0+20230204  First release
