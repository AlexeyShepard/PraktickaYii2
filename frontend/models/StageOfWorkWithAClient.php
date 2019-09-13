<?php
    namespace app\models;

    use yii\db\ActiveRecord;

    class StageOfWorkWithAClient extends ActiveRecord
    {
        public static function tableName()
        {
            return '{{Stage_of_work_with_a_client}}';
        }   
    }
?>