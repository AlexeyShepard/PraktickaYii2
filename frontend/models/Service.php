<?php

namespace app\models;

use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
	
	public static function tableName()
    {
        return '{{Service}}';
    }
}

?>