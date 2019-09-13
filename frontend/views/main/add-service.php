<a href="/frontend/web/main/services" title="Вернуться обратно к списку договоров" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use app\models\StageOfWorkWithAClient;
    use yii\db\Query;

    $form = ActiveForm::begin();   
?>   
    <?= $form->field($model, 'Service_name')->label('Наименование услуги')->hint("Не более 200 символов"); ?>
    <?= $form->field($model, 'Description')->label('Описание')->hint("Не более 200 символов"); ?>
    <?= $form->field($model, 'Cost')->label('Стоимость'); ?>

<button class="btn btn-primary">Создать</button>

<?php ActiveForm::end() ?>