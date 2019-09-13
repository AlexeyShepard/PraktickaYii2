<?php
    namespace app\models;

    use yii\db\ActiveRecord;

    class ContractOfOwners extends ActiveRecord
    {
        public static function tableName()
        {
            return '{{Immovables_of_owner}}';
        }
    }
?>