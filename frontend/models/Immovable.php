<?php

namespace app\models;

use yii\db\ActiveRecord;

class Immovable extends ActiveRecord
{
    /**
     * @var array содержит массив типов недвижимости
     */
    public $Id_immovable_type;

    public $Image;
    
    public static function tableName()
    {
        return '{{Immovable}}';
    }

    public function rules(){
        return [
            [['Name','Description','Cost','Id_immovable_type_FK'], 'required'],
            [['Image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if($this->validate())
        {
            $this->Image->saveAs("uploads/{$this->Image->baseName}.{$this->Image->extension}");
        }
        else
        {
            return false;
        }
    }
}

?>