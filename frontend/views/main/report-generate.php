<?php
    use yii\widgets\ActiveForm;
    $form = ActiveForm::begin();
?>
<form action="/frontend/web/main/report-generate" method="post">
    <label>Начало периода</label> <br>
    <input type="date" name="Begin_period" value="2019-01-01"/> <br>
    <label>Конец периода</label> <br>
    <input type="date" name="End_period" value="2019-01-01"/> <br> <br>
    <input type="submit" class="btn btn-primary btn-sm" value = "Сформировать отчёт"/>
</form>

<?php ActiveForm::end(); ?>
