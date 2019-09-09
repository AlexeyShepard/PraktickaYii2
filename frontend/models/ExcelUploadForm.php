<?php
    
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ExcelUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $excelFile;

    public function rules()
    {
        return [
            [['excelFile'],'file','skipOnEmpty' => false, 'extensions' => 'xlsx'],
        ];           
    }

    public function upload()
    {
        if($this->validate())
        {
            $this->excelFile->saveAs('uploads/' . $this->excelFile->baseName . '.' . $this->excelFile->extension); 
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>