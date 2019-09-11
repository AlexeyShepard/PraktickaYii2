<?php

namespace app\models;

use yii\db\ActiveRecord;

class Owner extends ActiveRecord
{   
    public static function tableName()
    {
        return '{{Owner}}';
    }
}

?>