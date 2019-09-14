<?php
    use yii\db\Query;
    use yii\data\ActiveDataProvider;
    use yii\grid\GridView;
    use yii\helpers\Html;
	use app\models\Owner;
	use app\models\StageOfWorkWithAClient;
	
	$owner = Owner::findOne($model['Id_owner_FK']);
	$stageOfWork = StageOfWorkWithAClient::findOne($model['Id_stage_of_work_with_a_client_FK']);
		
?>

<a href="/frontend/web/main/contracts" title="Вернуться обратно к списку договоров" data-pjax="0">
    <button class="btn btn-primary">Вернуться к списку договоров</button>
</a> 

<a href="/frontend/web/main/edit-contract?id=<?= $model['Id_contract']?>" title="Перейти к редактированию" data-pjax="0">
    <button class="btn btn-warning">Изменить</button>
</a> 

<a href="/frontend/web/main/delete-contract?id=<?= $model['Id_contract']?>" title="Удалить объект из базы данных" data-pjax="0">
    <button class="btn btn-danger">Удалить</button>
</a> 

<br> <br>
<h3>Информация об договоре</h3>
Номер договора: <?= $model['Number']; ?> <br> 
Итоговая сумма: <?= $model['Total_cost']; ?> <br>
Дата: <?= $model['Date']; ?> <br>
Этапы работы с клиентом: <?= $stageOfWork['Stage_of_work_with_a_client_name']; ?> <br>
Собственник договора: <a href="/frontend/web/main/owner?id=<?= $model['Id_owner_FK'] ?>"><?= $owner['Name']; ?></a> <br>
<br> <br>

<?php
	$query = new Query();
    $query->select(['Service.Id_service','Service.Service_name','Services_of_contract.Cost'])
    ->from('Services_of_contract')
    ->join('INNER JOIN', 'Service', 'Services_of_contract.id_service_FK = Service.Id_service')
    ->where(['Services_of_contract.Id_contract_FK' => $model['Id_contract']])
    ->all();
	

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);
?>

<div class="row">
    <div class="col-lg-6">
    <h3>Список услуг</h3>
    <a href="/frontend/web/main/add-service-to-contract?id=<?= $model['Id_contract']?>" title="Добавить услугу к договору" data-pjax="0">
        <button class="btn btn-primary">Добавить услугу</button>
    </a> 
    <br> <br>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'Service_name',
        'Cost',
		[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete-service}',
            'buttons' => [
                'delete-service' => function ($url, $model, $key) {
                    return Html::a('<button class="btn btn-danger btn-sm">Удалить из списка</button>', 'delete-service-to-contract?id='. $model['Id_service'] . "&ic=". $_GET['id'], [
                        'title' => 'Удалить услугу из списка',
                        'data-pjax' => '0',
                        ]);
                    },  
            ]
        ]
    ],
]); ?>
    </div>
    <div class="col-lg-6">
    <h3>Список недвижимости</h3>
    <a href="/frontend/web/main/add-immovable-to-contract?id=<?= $model['Id_contract']?>" title="Добавить недвижимость к договору" data-pjax="0">
        <button class="btn btn-primary">Добавить недвижимость</button>
    </a> 
    <br> <br>

<?php
    $query = new Query();
    $query->select(['Immovable.Id_immovable','Immovable.Name','Immovable.Cost'])
    ->from('Immovables_of_contract')
    ->join('INNER JOIN', 'Immovable', 'Immovables_of_contract.id_immovable_FK = Immovable.Id_immovable')
    ->where(['Immovables_of_contract.Id_contract_FK' => $model['Id_contract']])
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
            'template' => '{immovable} {delete-immovable}',
            'buttons' => [
                'immovable' => function ($url, $model, $key) {
                    return Html::a('<button class="btn btn-primary btn-sm">Просмотр</button>', 'immovable?id=' . $model['Id_immovable'], [
                        'title' => 'Перейти к просмотру информации',
                        'data-pjax' => '0',
                        ]);
                    },
                'delete-immovable' => function ($url, $model, $key) {
                    return Html::a('<button class="btn btn-danger btn-sm">Удалить из списка</button>', 'delete-immovable-to-contract?id='. $model['Id_immovable'] . "&ic=". $_GET['id'], [
                        'title' => 'Удалить недвижимость из списка',
                        'data-pjax' => '0',
                        ]);
                    },  
            ]
        ]
    ],
]); ?>

    </div>
</div>