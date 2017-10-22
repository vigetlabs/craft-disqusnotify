<?php
/**
 * Disqus Notify plugin for Craft CMS 3.x
 *
 * Notify authors when a comment is added via Disqus.
 *
 * @link      https://www.viget.com/
 * @copyright Copyright (c) 2017 Trevor Davis
 */

namespace viget\disqusnotify;

use viget\disqusnotify\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;

/**
 * Class DisqusNotify
 *
 * @author    Trevor Davis
 * @package   DisqusNotify
 * @since     2.0.0
 *
 */
class DisqusNotify extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var DisqusNotify
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
            'email' => \viget\disqusnotify\services\Email::class,
        ]);

        Craft::info('Disqus Notify plugin loaded', __METHOD__);
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'disqus-notify/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
