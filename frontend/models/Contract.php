<?php

namespace app\models;

use yii\db\ActiveRecord;

class Contract extends ActiveRecord
{   
    public static function tableName()
    {
        return '{{Contract}}';
    }
}

?>