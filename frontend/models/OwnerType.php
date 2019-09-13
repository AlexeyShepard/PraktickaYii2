<?php

namespace app\models;

use yii\db\ActiveRecord;

class OwnerType extends ActiveRecord
{   
	
	public static function tableName()
    {
        return '{{Owner_type}}';
    }
}

?>