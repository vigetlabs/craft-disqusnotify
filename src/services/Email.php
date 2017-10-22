<?php
/**
 * Disqus Notify plugin for Craft CMS 3.x
 *
 * Notify authors when a comment is added via Disqus.
 *
 * @link      https://www.viget.com/
 * @copyright Copyright (c) 2017 Trevor Davis
 */

namespace viget\disqusnotify\services;

use viget\disqusnotify\DisqusNotify;

use Craft;
use craft\base\Component;
use craft\mail\Message;
use craft\elements\User;
use craft\elements\Entry;

/**
 * @author    Trevor Davis
 * @package   DisqusNotify
 * @since     2.0.0
 */
class Email extends Component
{
    public $emailSettings;
    public $pluginSettings;
    public $message;
    public $mailer;

    public function __construct()
    {
        $this->emailSettings = Craft::$app->getSystemSettings()->getEmailSettings();
        $this->pluginSettings = DisqusNotify::$plugin->getSettings();
        $this->mailer = Craft::$app->getMailer();
        $this->message = new Message();

        $this->message->setFrom([$this->emailSettings['fromEmail'] => $this->emailSettings['fromName']]);
    }

    public function notify(User $author, Entry $entry, $comment)
    {
        $body = Craft::$app->getView()->renderString($this->pluginSettings['emailBody'], array(
            'author' => $author,
            'entry' => $entry,
            'comment' => $comment
        ));

        $this->message->setTo($author)
                      ->setSubject($this->pluginSettings['emailSubject'])
                      ->setTextBody($body);

        $this->mailer->send($this->message);
    }
}
