<a href="/frontend/web/main/contracts" title="Вернуться обратно к списку договоров" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use app\models\StageOfWorkWithAClient;
    use yii\db\Query;

    $form = ActiveForm::begin();   
?>   
    <?= $form->field($model, 'Number')->label('Номер заказа')->hint("5 символов"); ?>
    <?= $form->field($model, 'Total_cost')->label('Итоговая сумма')->hint("Не более 200 символов") ?>
    <?= $form->field($model, 'Id_stage_of_work_with_a_client_FK')->dropdownList($model->StageOfWork,
    ['prompt'=>'Выберите этап работы с клиентами'])->label("Этап работы с клиентом"); ?>
	<?= $form->field($model, 'Id_owner_FK')->dropdownList($model->Owners,
    ['prompt'=>'Выберите клиента'])->label("Клиент"); ?>

<button class="btn btn-primary">Создать</button>

<?php ActiveForm::end() ?>