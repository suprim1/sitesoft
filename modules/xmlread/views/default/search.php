    <?php

    if (empty($search)) {
        echo \app\modules\xmlread\widgets\xmlread\XmlreadWidget::widget(['okpd' => $okpd]);
    } else {
        echo \app\modules\xmlread\widgets\okpd\OkpdWidget::widget(['okpd' => $okpd]);
    }
    ?>