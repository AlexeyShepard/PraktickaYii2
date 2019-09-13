<a href="/frontend/web/main/owners" title="Вернуться обратно к списку собственников" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\db\Query;

    $form = ActiveForm::begin();   
?>   
    <?= $form->field($model, 'Name')->label('Название')->hint("Не более 200 символов"); ?>
    <?= $form->field($model, 'Phone_number')->label('Телефон')->hint("Ровно 11 символов"); ?>
	<?= $form->field($model, 'Email')->label('Email'); ?>
	<?= $form->field($model, 'INN')->label('INN')->hint("Ровно 9 символов"); ?>
	<?= $form->field($model, 'Id_owner_type_FK')->dropdownList($model->Owner_type,
    ['prompt'=>'Выберите тип'])->label("Тип собственника: "); ?>

<button class="btn btn-primary">Создать</button>

<?php ActiveForm::end() ?>