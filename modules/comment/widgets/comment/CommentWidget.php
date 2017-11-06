<?php

namespace app\modules\comment\widgets\comment;

class CommentWidget extends \yii\base\Widget
{

    public $comment;

    public function run()
    {

        return $this->render('comment', [
            'comment' => $this->comment,
        ]);
    }

}
