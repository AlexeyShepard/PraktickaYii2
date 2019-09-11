<?php
    namespace app\models;

    use yii\db\ActiveRecord;

    class ImmovableType extends ActiveRecord
    {
        public static function tableName()
        {
            return '{{Immovable_type}}';
        }   
    }
?>