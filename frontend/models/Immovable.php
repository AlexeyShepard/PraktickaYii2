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
            [['Name','Description','Cost','Id_immovable_type_FK'], 'required', 'message' => 'Поле не заполнено'],
            [['Image'], 'file', 'extensions' => 'png, jpg'],
            [['Name','Description'], 'string', 'max' => 200],
            ['Cost', 'double', 'message' => 'Введите числовое значение'],
            ['Cost', 'double', 'max' => 99999999999, 'message' => 'Слишком длинное значение'],
        ];
    }

    public function upload()
    {
        if($this->validate())
        {
            if($this->Image != null){
                $this->Image->saveAs("uploads/{$this->Image->baseName}.{$this->Image->extension}");
            }           
        }
        else
        {
            return false;
        }
    }
}

?>