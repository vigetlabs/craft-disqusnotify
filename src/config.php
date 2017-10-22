<?php
/**
 * Disqus Notify plugin for Craft CMS 3.x
 *
 * Notify authors when a comment is added via Disqus.
 *
 * @link      https://www.viget.com/
 * @copyright Copyright (c) 2017 Trevor Davis
 */

/**
 * Disqus Notify config.php
 *
 * This file exists only as a template for the Disqus Notify settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'disqus-notify.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
    'emailSubject' => 'Comment Posted',
    'emailBody' => 'You have received a new comment on your post.',
];
