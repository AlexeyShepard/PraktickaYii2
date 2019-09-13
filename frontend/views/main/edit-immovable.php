<a href="/main/immovable?id=<?= $_GET['id']?>" title="Вернуться обратно к списку недвижимости" data-pjax="0">
    <button class="btn btn-primary">Вернуться</button>
</a> <br> <br>

<?php
    use yii\widgets\ActiveForm;
    $form = ActiveForm::begin();   
?>
    
    <?= $form->field($model, 'Name')->label('Наименование'); ?>
    <?= $form->field($model, 'Description')->label('Описание')->textarea(); ?>
    <?= $form->field($model, 'Cost')->label('Стоимость'); ?>   
    <?= $form->field($model, 'Id_immovable_type_FK')->dropdownList($model->Id_immovable_type,
    ['prompt'=>'Выберите тип недвижимости'])->label("Тип недвижимости"); ?>
    <?= $form->field($model, 'Image')->fileInput()->label("Изображение");?>

<button class="btn btn-primary">Изменить</button>

<?php ActiveForm::end() ?>
