<a href="/main/contract?id=<?= $_GET['id'] ?>" title="Вернуться к информации об недвижимости" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?php
    use yii\grid\GridView;
    use app\models\Service;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Html;

    $query = Service::find();

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
        'Service_name',
		'Description',
		'Cost',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{add-service-to-contact-complete}',
            'buttons' => [
               'add-service-to-contact-complete' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Добавить</button>', 'add-service-to-contract-complete?id='. $model['Id_service'] . "&ic=" . $_GET['id'], [
                       'title' => 'Просмотреть информацию о договоре',
                       'data-pjax' => '0',
                        ]);
                    },
            ]
        ]
        ]
    ]);
?>