
<?php
use yii\widgets\ActiveForm;
?>
 
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'image')->fileInput()->label('Изображение') ?>
<button>Загрузить</button>
<?php ActiveForm::end() ?>

<?php if($model->image): ?>
    <img src="/uploads/<?= $model->image?>" alt="">
<?php endif; ?>