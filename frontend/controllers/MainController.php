<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\ExcelUploadForm;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 

class MainController extends Controller
{
    public function actionExcelUpload()
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
    }
}
?>