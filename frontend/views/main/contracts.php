<a href="/main/add-contract" title="Создать новую запись недвижимости" data-pjax="0">
    <button class="btn btn-primary">Создать</button>
</a> <br> <br>

<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\Contract;
use yii\helpers\html;

$query = Contract::find();

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
        'Number',
        'Date',
		[
         'class' => 'yii\grid\ActionColumn',
         'template' => '{contract} {edit-contract} {delete-contract}',
         'buttons' => [
            'contract' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-primary btn-sm">Просмотр</button>', $url, [
                    'title' => 'Просмотреть информацию о договоре',
                    'data-pjax' => '0',
                ]);
            },
            'edit-contract' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-warning btn-sm">Изменить</button>', $url, [
                    'title' => 'Изменить информацию о договоре',
                    'data-pjax' => '0',
                ]);  
            },
            'delete-contract' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-danger btn-sm">Удалить</button>', $url, [
                    'title' => 'Удалить информацию о договоре',
                    'data-pjax' => '0',
                ]);  
            },

            ]
		]
	],
]);

?>