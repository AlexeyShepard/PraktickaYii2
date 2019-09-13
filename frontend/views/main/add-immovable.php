<a href="/frontend/web/main/immovables" title="Вернуться обратно к списку недвижимости" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use app\models\ImmovableType;
    use yii\db\Query;

    $form = ActiveForm::begin();   
?>   
    <?= $form->field($model, 'Name')->label('Наименование')->hint("Не более 200 символов"); ?>
    <?= $form->field($model, 'Description')->label('Описание')->textarea()->hint("Не более 200 символов"); ?>
    <?= $form->field($model, 'Cost')->label('Стоимость')->hint("Не более 11 символов") ?>   
    <?= $form->field($model, 'Id_immovable_type_FK')->dropdownList($model->Id_immovable_type,
    ['prompt'=>'Выберите тип недвижимости'])->label("Тип недвижимости"); ?>
    <?= $form->field($model, 'Image')->fileInput()->label("Изображение");?>

<button class="btn btn-primary">Создать</button>

<?php ActiveForm::end() ?>