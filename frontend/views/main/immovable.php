<?
    use yii\db\Query;
    use yii\data\ActiveDataProvider;
    use yii\grid\GridView;
    use yii\helpers\Html;
?>

<a href="/frontend/web/main/immovables" title="Вернуться обратно к списку недвижимости" data-pjax="0">
    <button class="btn btn-primary">Вернуться</button>
</a> 

<a href="/frontend/web/main/edit-immovable?id=<?= $model['Id_immovable']?>" title="Перейти к редактированию" data-pjax="0">
    <button class="btn btn-warning">Изменить</button>
</a> 

<a href="/frontend/web/main/delete-immovable?id=<?= $model['Id_immovable']?>" title="Удалить объект из базы данных" data-pjax="0">
    <button class="btn btn-danger">Удалить</button>
</a> 

<br> <br>
<h3>Информация об недвижимости</h3>
Наименование недвижимости: <?= $model['Name']; ?> <br> 
Описание: <?= $model['Description']; ?> <br>
Стоимость: <?= $model['Cost']; ?>
<br> <br>
<?= Html::img(Yii::$app->urlManager->createUrl('uploads/' . $model['ImagePath'])) ?>
<br> <br>


<div class="row">
    <div class="col-lg-6">
    <h3>Список договоров</h3>
    <a href="/frontend/web/main/add-contract-to-immovable?id=<?= $model['Id_immovable']?>" title="Добавить договор к недвижимости" data-pjax="0">
        <button class="btn btn-primary">Добавить договор</button>
    </a>
    <br> <br>
<?
    $query = new Query();
    $query->select(['Contract.Id_contract','Contract.Number', 'Contract.Date'])
    ->from('Immovables_of_contract')
    ->join('LEFT JOIN', 'Contract', 'Immovables_of_contract.id_contract_FK = Contract.Id_contract')
    ->where(['Immovables_of_contract.Id_immovable_FK' => $model['Id_immovable']])
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
                    return Html::a('<button class="btn btn-danger btn-sm">Удалить из списка</button>', 'delete-contract-to-immovable?id='. $model['Id_contract'] . "&im=". $_GET['id'], [
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
    <h3>Список собственников</h3>
    <a href="/frontend/web/main/add-owner-to-immovable?id=<?= $model['Id_immovable']?>" title="Добавить собственника к недвижимости" data-pjax="0">
        <button class="btn btn-primary">Добавить собственника</button>
    </a>
    <br> <br>
<?

    $query = new Query();
    $query->select(['Owner.Id_owner','Owner.Name','Owner.Phone_number', 'Owner.Email'])
    ->from('Immovables_of_owner')
    ->join('LEFT JOIN', 'Owner', 'Immovables_of_owner.id_owner_FK = Owner.Id_owner')
    ->where(['Immovables_of_owner.Id_immovable_FK' => $model['Id_immovable']])
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
        'Phone_number',
        'Email',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{owner} {delete-owner}',
            'buttons' => [
               'owner' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Просмотр</button>', 'owner?id='. $model['Id_owner'], [
                       'title' => 'Просмотреть информацию о владельце',
                       'data-pjax' => '0',
                        ]);
                    },
                'delete-owner' => function ($url, $model, $key) {
                    return Html::a('<button class="btn btn-danger btn-sm">Удалить из списка</button>', 'delete-owner-to-immovable?id='. $model['Id_owner'] . "&im=". $_GET['id'], [
                        'title' => 'Удалить владельца из списка',
                        'data-pjax' => '0',
                        ]);
                    },  
            ]
        ]
    ],
]); ?>
    </div>
</div>




