<?
    namespace app\models;

    use yii\db\ActiveRecord;

    class OwnerOfImmovables extends ActiveRecord
    {
        public static function tableName()
        {
            return '{{Immovables_of_owner}}';
        }
    }
?>