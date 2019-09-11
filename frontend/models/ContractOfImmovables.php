<?
    namespace app\models;

    use yii\db\ActiveRecord;

    class ContractOfImmovables extends ActiveRecord
    {
        public static function tableName()
        {
            return '{{Immovables_of_contract}}';
        }
    }
?>