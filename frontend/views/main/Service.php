<?php
    use yii\db\Query;
    use yii\data\ActiveDataProvider;
    use yii\grid\GridView;
    use yii\helpers\Html;
?>

<a href="/frontend/web/main/services" title="Вернуться обратно к списку услуг" data-pjax="0">
    <button class="btn btn-primary">Вернуться к списку недвижимости</button>
</a> 

<a href="/frontend/web/main/edit-service?id=<?= $model['Id_service']?>" title="Перейти к редактированию" data-pjax="0">
    <button class="btn btn-warning">Изменить</button>
</a> 

<a href="/frontend/web/main/delete-service?id=<?= $model['Id_service']?>" title="Удалить объект из базы данных" data-pjax="0">
    <button class="btn btn-danger">Удалить</button>
</a> 

<br> <br>
<h3>Информация об услуге</h3>
Наименование услуги: <?= $model['Service_name']; ?> <br> 
Описание: <?= $model['Description']; ?> <br>
Стоимость: <?= $model['Cost']; ?>