<?php
namespace Craft;

class DisqusNotify_NotifyController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionNotify()
    {
        $this->requirePostRequest();
        $this->requireAjaxRequest();

        $comment = craft()->request->getPost('comment');
        $entryId = craft()->request->getPost('entryId');
        $authorId = craft()->request->getPost('authorId');

        $entry = craft()->entries->getEntryById((int) $entryId);
        $author = craft()->users->getUserById((int) $authorId);

        craft()->disqusNotify_email->notify($author, $entry, $comment);

        $this->returnJson(array(
            'success' => true
        ));
    }
}
