<?php

namespace app\models;

use yii\db\ActiveRecord;

class Contract extends ActiveRecord
{   
    public $StageOfWork;
	
	public $Owners;
	
	public static function tableName()
    {
        return '{{Contract}}';
    }
	
	public function rules(){
        return [
            [['Number','Id_owner_FK','Id_stage_of_work_with_a_client_FK'], 'required', 'message' => 'Поле не заполнено'],
            ['Number', 'number', 'min' => 9999, 'max' => 99999, 'message' => 'Номер заказ введёт не корректно'],
            ['Total_cost', 'double', 'message' => 'Введите числовое значение'],
            ['Total_cost', 'double', 'max' => 99999999999, 'message' => 'Слишком длинное значение'],
        ];
    }
}

?>