<?php

namespace app\models;

use yii\db\ActiveRecord;

class ServicesOfContract extends ActiveRecord
{
	public static function tableName()
    {
        return '{{Services_of_contract}}';
    }
}

?>