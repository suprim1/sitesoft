<?php

namespace app\modules\xmlread\widgets\okpd;

class OkpdWidget extends \yii\base\Widget {

    public $okpd;

    public function run() {

        return $this->render('okpd', [
                    'okpd' => $this->okpd,
        ]);
    }

}
