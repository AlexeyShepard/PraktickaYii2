<a href="/frontend/web/main/owner?id=<?= $_GET['id'] ?>" title="Вернуться к информации об собственности" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?php
    use yii\grid\GridView;
    use app\models\Contract;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Html;

    $query = Contract::find();

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
            'template' => '{add-contract-to-owner-complete}',
            'buttons' => [
               'add-contract-to-owner-complete' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Добавить</button>', 'add-contract-to-owner-complete?id='. $model['Id_contract'] . "&iw=" . $_GET['id'], [
                       'title' => 'Просмотреть информацию о договоре',
                       'data-pjax' => '0',
                        ]);
                    },
            ]
        ]
        ]
    ]);
?>