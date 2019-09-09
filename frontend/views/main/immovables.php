<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\Immovable;

$query = Immovable::find();

//$query->select('Name','Cost')->from("Immovable");

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
        'Cost',
		['class' => 'yii\grid\ActionColumn',
		 'template' => '{view}',
		 //'view' => function()
		]
	],
]);

?>