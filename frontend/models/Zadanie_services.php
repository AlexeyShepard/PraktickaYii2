<?php

namespace app\models;

use yii\db\ActiveRecord;

class Zadanie_services extends ActiveRecord
{
    public static function tableName()
    {
        return '{{Zadanie_services}}';
    }
}

?>