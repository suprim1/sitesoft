<div class="panel-group" id="accordion">
    <?php foreach ($okpd as $line): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="<?= $toggle ? 'js-onclick-open' : null ?> js-okpd-open " data-toggle="collapse" data-parent="#accordion" href="#<?= $line['Kod'] ?>" data-kod="<?= $line['Kod'] ?>">
                        <?= $line['Kod'] . ' ' . $line['Name'] ?>
                    </a>
                </h4>
            </div>
            <div id="<?= $line['Kod'] ?>" class="panel-collapse collapse">
                <div class="panel-body">
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>