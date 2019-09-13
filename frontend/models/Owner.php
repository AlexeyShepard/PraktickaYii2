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
			[['Name', 'Phone_number','Email', 'INN', 'Id_owner_type_FK'], 'required']
		];
	}
}

?>