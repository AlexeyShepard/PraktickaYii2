<?php 

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?= $this->head() ?>
        </head>
    <body>
    <?= $this->beginBody() ?>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="/images/Logo.png">
            </a>
        </nav>

        <?= $content ?>

    <?= $this->endBody() ?>
    </body>
</html>
<?= $this->endPage() ?>