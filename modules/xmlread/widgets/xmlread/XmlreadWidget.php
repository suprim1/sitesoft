<?php

namespace app\modules\xmlread\widgets\xmlread;

class XmlreadWidget extends \yii\base\Widget
{

    public $okpd;
    public $toggle = false;

    public function run()
    {

        return $this->render('xmlread', [
            'okpd' => $this->okpd,
            'toggle' => $this->toggle,
        ]);
    }

}
