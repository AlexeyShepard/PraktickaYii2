<a href="/frontend/web/main/contract?id=<?= $_GET['id'] ?>" title="Вернуться к информации о договоре" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?php
    use yii\grid\GridView;
    use app\models\Immovable;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Html;

    $query = Immovable::find();

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
            'template' => '{add-immovable-to-contract-complete}',
            'buttons' => [
               'add-immovable-to-contract-complete' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Добавить</button>', 'add-immovable-to-contract-complete?id='. $model['Id_immovable'] . "&ic=" . $_GET['id'], [
                       'title' => 'Просмотреть информацию о договоре',
                       'data-pjax' => '0',
                        ]);
                    },
            ]
        ]
        ]
    ]);
?>
