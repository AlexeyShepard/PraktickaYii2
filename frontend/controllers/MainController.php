<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadImage;
use yii\web\UploadedFile;
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 

class MainController extends Controller
{
    /*public function actionExcelUpload()
    {
        $model = new ExcelUploadForm();

        if(Yii::$app->request->isPost)
        {
            $model->excelFile = Uploaded::getInstance($model, 'excelFile');
            if ($model->upload())
            {
                return;
            }
        }

        return $this->render('excel-upload', ['model' => $model]);
    }*/
	
	public function actionIndex(){
		
		return $this->render("index");
	}
	
	public function actionImmovables(){
		return $this->render("immovables");		
	}

	public function actionUpload(){
		$model = new UploadImage();
		if(Yii::$app->request->isPost){
			$model->image = UploadedFile::getInstance($model, 'image');
			$model->upload();
        return $this->render('upload-image', ['model' => $model]);
    }
    return $this->render('upload-image', ['model' => $model]);
}
}
?>