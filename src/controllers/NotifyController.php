<?php
/**
 * Disqus Notify plugin for Craft CMS 3.x
 *
 * Notify authors when a comment is added via Disqus.
 *
 * @link      https://www.viget.com/
 * @copyright Copyright (c) 2017 Trevor Davis
 */

namespace viget\disqusnotify\controllers;

use viget\disqusnotify\DisqusNotify;
use Craft;
use craft\web\Controller;

/**
 * @author    Trevor Davis
 * @package   DisqusNotify
 * @since     2.0.0
 */
class NotifyController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['notify'];

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionNotify()
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();

        if (!$request->isAjax) return false;

        $postParams = \Craft::$app->request->getBodyParams();
        $comment = $postParams['comment'];
        $entryId = $postParams['entryId'];
        $authorId = $postParams['authorId'];

        $author = \Craft::$app->users->getUserById((int) $authorId);
        $entry = \Craft::$app->entries->getEntryById((int) $entryId);

        DisqusNotify::getInstance()->email->notify($author, $entry, $comment);

        return $this->asJson(['success' => true]);
    }
}
