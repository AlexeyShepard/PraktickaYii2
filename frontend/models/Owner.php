<?php

namespace app\models;

use yii\db\ActiveRecord;

class Owner extends ActiveRecord
{   
    
	public $Owner_type;
	
	public static function tableName()
    {
        return '{{Owner}}';
    }
	
	public function rules()
	{
		return [
			[['Name', 'Phone_number','Email', 'INN', 'Id_owner_type_FK'], 'required', 'message' => 'Поле не заполнено'],
			['Name', 'string', 'max' => 200, 'message' => 'Поле содержит больше 200 символов'],
			['Phone_number', 'number', 'max' => 99999999999, 'min' => 9999999999, 'message' => 'Номер телефона имеет не корректный формат'],
			['Email','email', 'message' => 'Поле заполнено не корректно'],
			['INN', 'number', 'max' => 999999999, 'min' => 99999999, 'message' => 'Поле должно содержать 9 символов'],
		];
	}
}

?>