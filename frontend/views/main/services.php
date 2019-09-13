<a href="/frontend/web/main/add-service" title="Создать новую запись услуги" data-pjax="0">
    <button class="btn btn-primary">Создать</button>
</a> <br> <br>

<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\Service;
use yii\helpers\html;

$query = Service::find();

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
        'Service_name',
        'Cost',
		[
         'class' => 'yii\grid\ActionColumn',
         'template' => '{service} {edit-service} {delete-service}',
         'buttons' => [
            'service' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-primary btn-sm">Просмотр</button>', $url, [
                    'title' => 'Просмотреть информацию об услуге',
                    'data-pjax' => '0',
                ]);
            },
            'edit-service' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-warning btn-sm">Изменить</button>', $url, [
                    'title' => 'Изменить информацию об услуге',
                    'data-pjax' => '0',
                ]);  
            },
            'delete-service' => function ($url, $model, $key) {
                return Html::a('<button class="btn btn-danger btn-sm">Удалить</button>', $url, [
                    'title' => 'Удалить информацию об услуге',
                    'data-pjax' => '0',
                ]);  
            },
            ]
		]
	],
]);

?>