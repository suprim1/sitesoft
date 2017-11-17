<div class="panel-group" id="accordion">
    <?php foreach ($okpd as $line): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="js-onclick-open" data-toggle="collapse" data-parent="#accordion" href="#<?= $line['Kod'] ?>">
                        <?= $line['Kod'] . ' ' . $line['Name'] ?>
                    </a>
                </h4>
            </div>
            <div id="<?= $line['Kod'] ?>" class="panel-collapse in collapse">
                <div class="panel-body">
                    <?php if (isset($line['sub'])): ?>
                        <?= \app\modules\xmlread\widgets\okpd\OkpdWidget::widget(['okpd' => $line['sub']]) ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>