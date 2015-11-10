Email To Slack Integration
==========================

Slack to Email detects new emails in an IMAP inbox (tested with Gmail for Business) every 15 seconds and sends a message to Slack with the subject, sender and 140 characters of the body. It also marks the email as read once done. **It is ideally used as a service to share an email or email chain into Slack.**

There are four files. *check.php* authenticates into the IMAP provider, downloads a list of emails, iterates through the unread emails, and sends a message to a Slack channel using Slack's API (via *slack-send.php*). check.php should be run by a cronjob or similar every 15 seconds (or as frequently as you like). view.php provides an external link from Slack to your web server, and takes two parameters - the unique email ID as described by the IMAP server **(uid)** and a salted MD5 string of the unix timestamp **(secret)**. Finally, the *config.php* file needs to be filled out before running the script.

Oh yeah, you'll need the imap module for PHP5. Plenty of guides on how to install it if you don't have it on your web server.

Install instructions:
=====================

1. Set up email (i.e. slack@yourcompany.com)
1. Configure config.php
1. Enable cronjob (see below)
1. Test it out!

The cronjob:

    * * * * * php /YOUR/PATH/check.php
    * * * * * sleep 15; php /YOUR/PATH/check.php
    * * * * * sleep 30; php /YOUR/PATH/check.php
    * * * * * sleep 45; php /YOUR/PATH/check.php

--------------------------------

- **Used with:** Slack, Email (IMAP), Web Server
- **For:** Posts message on Slack upon new mail / Send Slack message via email
- **Author:** Matt Withoos
- **Author URI:** http://mattwithoos.com
- **Credits:** Inspired by David Walsh: https://davidwalsh.name/gmail-php-imap
- **Description:** The Email to Slack integration provides an open-source, free alternative to the paid offering by Slack for organisations or individuals who can't afford to pay a per-user, per-month fee. Slack to Email detects new emails in an IMAP inbox on a regularity that you can set, sends a message to Slack using the Slack API over CURL, and then marks the email as read. It also allows read access to the email, authenticating access on a per-email basis.
- **Version:** 1.0.0
- **License:** GNU General Public License v3 or later
- **License URI:** http://www.gnu.org/licenses/gpl-3.0.html
- **Tags:** php, email to slack, email2slack, email, slack, email2slack integration, email to slack integration, integration, imap, gmail, gmail slack integration
