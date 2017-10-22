<?php
/**
 * Disqus Notify plugin for Craft CMS 3.x
 *
 * Notify authors when a comment is added via Disqus.
 *
 * @link      https://www.viget.com/
 * @copyright Copyright (c) 2017 Trevor Davis
 */

namespace viget\disqusnotify\models;

use viget\disqusnotify\DisqusNotify;

use Craft;
use craft\base\Model;

/**
 * @author    Trevor Davis
 * @package   DisqusNotify
 * @since     2.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $emailSubject = 'Comment Posted';
    public $emailBody = 'You have received a new comment on your post.';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emailSubject', 'emailBody'], 'required'],
        ];
    }
}
