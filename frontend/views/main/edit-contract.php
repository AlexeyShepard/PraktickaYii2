<a href="/main/contract?id=<?= $_GET['id']?>" title="Вернуться обратно к списку договоров" data-pjax="0">
    <button class="btn btn-primary">Вернуться</button>
</a> <br> <br>

<?php
    use yii\widgets\ActiveForm;
    $form = ActiveForm::begin();   
?>
    
    <?= $form->field($model, 'Number')->label('Номер заказа'); ?>
    <?= $form->field($model, 'Total_cost')->label('Итоговая сумма'); ?>
    <?= $form->field($model, 'Id_stage_of_work_with_a_client_FK')->dropdownList($model->StageOfWork,
    ['prompt'=>'Выберите этап работы с клиентами'])->label("Этап работы с клиентом"); ?>
	<?= $form->field($model, 'Id_owner_FK')->dropdownList($model->Owners,
    ['prompt'=>'Выберите клиента'])->label("Клиент"); ?>

<button class="btn btn-primary">Изменить</button>

<?php ActiveForm::end() ?>
