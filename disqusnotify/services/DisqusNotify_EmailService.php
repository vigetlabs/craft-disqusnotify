<?php
namespace Craft;

class DisqusNotify_EmailService extends BaseApplicationComponent
{
    public $email;
    public $emailSettings;
    public $pluginSettings;

    public function __construct()
    {
        $this->email = new EmailModel();
        $this->emailSettings = craft()->email->getSettings();

        $this->email->fromEmail = $this->emailSettings['emailAddress'];
        $this->email->sender = $this->emailSettings['emailAddress'];
        $this->email->fromName = $this->emailSettings['senderName'];

        $this->pluginSettings = craft()->plugins->getPlugin('disqusnotify')->getSettings();
    }

    public function notify(UserModel $author, EntryModel $entry, $comment)
    {
        $this->email->toEmail = $author->email;
        $this->email->subject = $this->pluginSettings['emailSubject'];
        $this->email->body = craft()->templates->renderString($this->pluginSettings['emailBody'], array(
            'author' => $author,
            'entry' => $entry,
            'comment' => $comment
        ));

        craft()->email->sendEmail($this->email);
    }
}
