<?php

namespace app\models;

use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
	
	public static function tableName()
    {
        return '{{Service}}';
    }

    public function rules(){
        return [
            [['Service_name','Description','Cost'], 'required'],
            [['Service_name', 'Description'], 'string', 'max' => 200],
            ['Cost', 'double', 'message' => 'Введите числовое значение'],
            ['Cost', 'double', 'max' => 99999999999, 'message' => 'Слишком длинное значение'],
        ];
    }
}

?>