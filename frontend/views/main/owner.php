<?php
    use yii\db\Query;
    use yii\data\ActiveDataProvider;
    use yii\grid\GridView;
    use yii\helpers\Html;
?>

<a href="/frontend/web/main/owners" title="Вернуться обратно к списку недвижимости" data-pjax="0">
    <button class="btn btn-primary">Вернуться к списку собственности</button>
</a> 

<a href="/frontend/web/main/edit-owner?id=<?= $model['Id_owner']?>" title="Перейти к редактированию" data-pjax="0">
    <button class="btn btn-warning">Изменить</button>
</a> 

<a href="/frontend/web/main/delete-owner?id=<?= $model['Id_owner']?>" title="Удалить объект из базы данных" data-pjax="0">
    <button class="btn btn-danger">Удалить</button>
</a> 

<br> <br>
<h3>Информация о собственнике</h3>
ФИО/Название организации: <?= $model['Name']; ?> <br> 
Номер телефона: <?= $model['Phone_number']; ?> <br>
Email: <?= $model['Email']; ?> <br>
ИНН: <?= $model['INN']; ?>
<br> <br>

<div class="row">
    <div class="col-lg-6">
    <h3>Список договоров</h3>
    <a href="/frontend/web/main/add-contract?id=<?= $model['Id_owner']?>" title="Добавить договор к собственнику" data-pjax="0">
        <button class="btn btn-primary">Создать договор</button>
    </a>
    <br> <br>
<?php
    $query = new Query();
    $query->select(['Id_contract','Number', 'Date'])
    ->from('Contract')
    ->where(['Id_owner_FK' => $model['Id_owner']])
    ->all();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'Number',
        'Date',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{contract} {delete-contract}',
            'buttons' => [
               'contract' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Просмотр</button>', 'contract?id='. $model['Id_contract'], [
                       'title' => 'Просмотреть информацию о договоре',
                       'data-pjax' => '0',
                        ]);
                    },
                'delete-contract' => function ($url, $model, $key) {
                    return Html::a('<button class="btn btn-danger btn-sm">Удалить из списка</button>', 'delete-contract-to-owner?id='. $model['Id_contract'] . "&iw=". $_GET['id'], [
                        'title' => 'Удалить контракт из списка',
                        'data-pjax' => '0',
                        ]);
                    },  
            ]
        ]
    ],
]); ?>
    </div>
    <div class = "col-lg-6">
    <h3>Список недвижимимости</h3>
    <a href="/frontend/web/main/add-immovable-to-owner?id=<?= $model['Id_owner']?>" title="Добавить недвижимость к собственнику" data-pjax="0">
        <button class="btn btn-primary">Добавить недвижимимость</button>
    </a>
    <br> <br>
<?php

    $query = new Query();
    $query->select(['Immovable.Id_immovable','Immovable.Name','Immovable.Cost'])
    ->from('Immovables_of_owner')
    ->join('LEFT JOIN', 'Immovable', 'Immovables_of_owner.id_immovable_FK = Immovable.Id_immovable')
    ->where(['Immovables_of_owner.Id_owner_FK' => $model['Id_owner']])
    ->all();
    
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'Name',
        'Cost',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{owner} {delete-owner}',
            'buttons' => [
               'owner' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Просмотр</button>', 'immovable?id='. $model['Id_immovable'], [
                       'title' => 'Просмотреть информацию о недвижимимости',
                       'data-pjax' => '0',
                        ]);
                    },
                'delete-owner' => function ($url, $model, $key) {
                    return Html::a('<button class="btn btn-danger btn-sm">Удалить из списка</button>', 'delete-immovable-to-owner?id='. $model['Id_immovable'] . "&iw=". $_GET['id'], [
                        'title' => 'Удалить недвижимимость из списка',
                        'data-pjax' => '0',
                        ]);
                    },  
            ]
        ]
    ],
]); ?>
    </div>
</div>




