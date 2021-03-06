<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Тест',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'RBAC', 'url' => ['/']],
                    ['label' => 'Справочник', 'url' => ['/xmlread']],
                    ['label' => 'Скобки', 'url' => ['/brackets']],
                    ['label' => 'Rest', 'url' => ['/rest']],
                    Yii::$app->user->isGuest ? (
                            ['label' => 'Вход', 'url' => ['/login']]
                            ) :
                            ['label' => 'Выход (' . Yii::$app->user->identity->login . ')', 'url' => ['/logout']]
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?= $content ?>
            </div>
        </div>

        <footer class="footer footer__height">
            <div class="container">
                <p class="pull-ctnter"><?= \app\widgets\uniqueness\UniquenessWidget::widget() ?></p>
                <p class="pull-left">&copy; Тест <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
        <?= \app\widgets\yandexMetrika\YandexMetrikaWidget::widget() ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
