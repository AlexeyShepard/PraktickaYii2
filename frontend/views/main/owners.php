<a href="/frontend/web/main/add-owner" title="Создать нового собственника" data-pjax="0">
    <button class="btn btn-primary">Создать</button>
</a> <br> <br>

<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\Contract;
use yii\helpers\html;

	//$query = Owner::find();
	$query = new Query();
    $query->select(['Owner.Id_owner','Owner.Name', 'Owner.Phone_number', 'Owner.Email', 'Owner_type.Owner_type_name'])
    ->from('Owner_type')
    ->join('INNER JOIN', 'Owner', 'Owner_type.Id_owner_type = Owner.Id_owner_type_FK')
    ->all();

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
	'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        // Обычные поля определенные данными содержащимися в $dataProvider.
        // Будут использованы данные из полей модели.
        'Name',
        'Phone_number',
		'Email',
		'Owner_type_name',
		[
         'class' => 'yii\grid\ActionColumn',
         'template' => '{owner} {edit-owner} {delete-owner}',
         'buttons' => [
            'owner' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-primary btn-sm">Просмотр</button>', 'owner?id='. $model["Id_owner"], [
                    'title' => 'Просмотреть информацию о собсвеннике',
                    'data-pjax' => '0',
                ]);
            },
            'edit-owner' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-warning btn-sm">Изменить</button>', 'edit-owner?id='. $model["Id_owner"], [
                    'title' => 'Изменить информацию о собсвеннике',
                    'data-pjax' => '0',
                ]);  
            },
            'delete-owner' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-danger btn-sm">Удалить</button>', 'delete-owner?id='. $model["Id_owner"] , [
                    'title' => 'Удалить информацию о собсвеннике',
                    'data-pjax' => '0',
                ]);  
            },

            ]
		]
	],
]);

?>