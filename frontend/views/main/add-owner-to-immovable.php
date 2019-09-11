<a href="/frontend/web/main/immovable?id=<?= $_GET['id'] ?>" title="Вернуться к информации об недвижимости" data-pjax="0">
    <button class="btn btn-primary">Отмена</button>
</a> <br> <br>

<?
    use yii\grid\GridView;
    use app\models\Owner;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Html;

    $query = Owner::find();

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
        'Phone_number',
        'Email',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{add-owner-to-immovable-complete}',
            'buttons' => [
               'add-owner-to-immovable-complete' => function ($url, $model, $key) {
                   return Html::a('<button class="btn btn-primary btn-sm">Добавить</button>', 'add-owner-to-immovable-complete?id='. $model['Id_owner'] . "&im=" . $_GET['id'], [
                       'title' => 'Просмотреть информацию о собственнике',
                       'data-pjax' => '0',
                        ]);
                    },
            ]
        ]
        ]
    ]);
?>