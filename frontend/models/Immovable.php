<?php

namespace app\models;

use yii\db\ActiveRecord;

class Immovable extends ActiveRecord
{
	public static function tableName()
    {
        return '{{Immovable}}';
    }
}

?>