<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    $form->field($model, 'excelFile')->fileInput();
    
    Html::submitButton();

    ActiveForm::end();
?>