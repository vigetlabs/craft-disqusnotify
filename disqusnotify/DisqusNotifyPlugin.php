<?php
namespace Craft;

class DisqusNotifyPlugin extends BasePlugin
{
    public function getName()
    {
         return Craft::t('Disqus Notify');
    }

    public function getDescription()
    {
        return 'Notify authors when a comment is added via Disqus';
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'Trevor Davis';
    }

    public function getDeveloperUrl()
    {
        return 'https://viget.com';
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/vigetlabs/craft-disqusnotify';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/vigetlabs/craft-disqusnotify/master/releases.json';
    }

    protected function defineSettings()
    {
        return array(
            'emailSubject' => array(AttributeType::Mixed, 'default' => 'Comment Posted'),
            'emailBody' => array(AttributeType::Mixed, 'default' => 'You have received a new comment on your post.')
        );
    }

    public function getSettingsHtml()
    {
        if (craft()->request->getPath() === 'settings/plugins')
        {
            return true;
        }
        return craft()->templates->render('disqusnotify/settings', array(
            'settings' => $this->getSettings()
        ));
    }

}
