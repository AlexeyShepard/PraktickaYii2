<a href="/main/owner?id=<?= $_GET['id'] ?>" title="Вернуться к информации об собственнике" data-pjax="0">
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
            'template' => '{add-immovable-to-owner-complete}',
            'buttons' => [
               'add-immovable-to-owner-complete' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Добавить</button>', 'add-immovable-to-owner-complete?id='. $model['Id_immovable'] . "&iw=" . $_GET['id'], [
                       'title' => 'Просмотреть информацию о договоре',
                       'data-pjax' => '0',
                        ]);
                    },
            ]
        ]
        ]
    ]);
?>
