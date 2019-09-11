<a href="/frontend/web/main/immovable?id=<?= $_GET['id'] ?>" title="Вернуться к информации об недвижимости" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?
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
            'template' => '{add-control-to-immovable-complete}',
            'buttons' => [
               'add-control-to-immovable-complete' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Добавить</button>', 'add-contract-to-immovable-complete?id='. $model['Id_contract'] . "&im=" . $_GET['id'], [
                       'title' => 'Просмотреть информацию о договоре',
                       'data-pjax' => '0',
                        ]);
                    },
            ]
        ]
        ]
    ]);
?>

