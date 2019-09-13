<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use app\models\UploadImage;
use yii\web\UploadedFile;
use app\models\Immovable;
use app\models\ImmovableType;
use app\models\StageOfWorkWithAClient;
use app\models\Zadanie_services;
use app\models\Contract;
use app\models\ContractOfImmovables;
use app\models\ContractOfOwners;
use app\models\OwnerOfImmovables;
use app\models\Owner;
use app\models\OwnerType;
use app\models\Service;
use app\models\ServicesOfContract;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 

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
	
    /**
     * Главная страница сайта
     */
    public function actionIndex(){
		
		return $this->render("index");
	}
	
    /**
     * Вывод вида с таблицей всей недвижимости
     */
    public function actionImmovables(){
		return $this->render("immovables");		
    }
    
    /**
     * Вывод вида просмотра информации об недвижимости
     */
    public function actionImmovable(){
        $id = $_GET['id'];
        $model = Immovable::findOne($id);

        return $this->render("immovable", ['model' => $model]);
    }

    /**
     * Добавить недвижимость
     */
    public function actionAddImmovable(){
        
        $model = new Immovable();
        
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $model->Image = UploadedFile::getInstance($model, 'Image');
            $model->upload();
            $model->ImagePath = $model->Image->baseName . "." . $model->Image->extension;
            $model->Image = null;
            $model->save();

            return $this->redirect("/main/immovable?id=" . $model['Id_immovable']);
        }
        else
        {
            $id = ImmovableType::find()->select('Id_Immovable_type')->column();
			$name = ImmovableType::find()->select('Immovable_type_name')->column();
			$model->Id_immovable_type = $this->DropDownMap($id, $name);
            return $this->render("add-immovable", ['model' => $model]);
        }
           
    }

    /**
     * Вывод вида редактирования информации об недвижимости
     */
    public function actionEditImmovable(){
        
        $model = new Immovable();
        
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $update_model = Immovable::findOne($_GET['id']);

            $update_model['Id_immovable'] = $_GET['id'];
            $update_model['Name'] = $model['Name'];
            $update_model["Description"] = $model["Description"];
            $update_model["Cost"] = $model["Cost"];
            $update_model["Id_immovable_type_FK"] = $model["Id_immovable_type_FK"];
            $update_model->Image = UploadedFile::getInstance($model, 'Image');
            $update_model->upload();
            $update_model['ImagePath'] = $update_model->Image->baseName . "." . $update_model->Image->extension;
            $update_model->Image = null;

            $update_model->update();

            return $this->redirect("/main/immovable?id=" . $_GET['id']);
        }
        else
        {
            $id = $_GET['id'];
            $model = Immovable::findOne($id);

            $id = ImmovableType::find()->select('Id_Immovable_type')->column();
			$name = ImmovableType::find()->select('Immovable_type_name')->column();
			$model->Id_immovable_type = $this->DropDownMap($id, $name);

        return $this->render("edit-immovable", ['model' => $model]);
        }    
    }

    /**
     * Удаление недвижимости
     */
    public function actionDeleteImmovable(){
        $id = $_GET['id'];

        $model = Immovable::findOne($id);
        $model->delete();

        return $this->redirect("/main/immovables");
    }

    /**
     * Для загрузки картинки
     */
    public function actionUpload(){
		$model = new UploadImage();
        if(Yii::$app->request->isPost)
        {
			$model->image = UploadedFile::getInstance($model, 'image');
			$model->upload();
            return $this->render('upload-image', ['model' => $model]);
        }   

        return $this->render('upload-image', ['model' => $model]);
    }

    /**
     * Отображения списка контрактов для добавления к недвижимости
     */
    public function actionAddContractToImmovable()
    {       
        return $this->render('add-contract-to-immovable');
    }

    /**
     * Процесс добавления выбранного договора в недвижимости
     */
    public function actionAddContractToImmovableComplete()
    {
        $Id_immovable = $_GET['im'];
        $Id_contract = $_GET['id'];

        $model = new ContractOfImmovables();
        $Immovable_cost = Immovable::findOne($_GET['im']);

        $model->Id_contract_FK = $Id_contract;
        $model->Id_immovable_FK = $Id_immovable;
        $model->Cost = $Immovable_cost->Cost;

        $model->save();

        return $this->redirect("/main/immovable?id=" . $_GET['im']);
    }

    /**
     * Процесс удаления выбранного контракта из списка недвижимости
     */
    public function actionDeleteContractToImmovable()
    {
        $Id_immovable = $_GET['im'];
        $Id_contract = $_GET['id'];
        
        $ContractToDelete = ContractOfImmovables::find()->where(['Id_immovable_FK' => $Id_immovable, 'Id_contract_FK' => $Id_contract])->one();
        $ContractToDelete->delete();

        return $this->redirect("/main/immovable?id=" . $_GET['im']);
    }

    /**
     * Отображение списка собственников для добавления к недвижимости
     */
    public function actionAddOwnerToImmovable()
    {
        return $this->render('add-owner-to-immovable');
    }
    
    /**
     * Процесс добавления выбранного собственника к недвижимости
     */
    public function actionAddOwnerToImmovableComplete()
    {
        $Id_immovable = $_GET['im'];
        $Id_owner = $_GET['id'];

        $model = new OwnerOfImmovables();

        $model->Id_owner_FK = $Id_owner;
        $model->Id_immovable_FK = $Id_immovable;

        $model->save();

        return $this->redirect("/main/immovable?id=" . $_GET['im']);
    }

    /**
     * Процесс удаления выбранного собственника из списка недвижимости
     */
    public function actionDeleteOwnerToImmovable()
    {
        $Id_immovable = $_GET['im'];
        $Id_owner = $_GET['id'];   
        
        $OwnerToDelete = OwnerOfImmovables::find()->where(['Id_immovable_FK' => $Id_immovable, 'Id_owner_FK' => $Id_owner])->one();
        $OwnerToDelete->delete();

        return $this->redirect("/main/immovable?id=" . $_GET['im']);
    }
	
	/**
	 * Вывод всего списка договоров 
	 */
	public function actionContracts()
	{
		return $this->render('contracts');
	}
	
	/**
	 * Вывод информации об договоре
	 */
	public function actionContract()
	{
		$model = Contract::findOne($_GET['id']);
		
		return $this->render('contract', ['model' => $model]);
	}
	
	/**
     * Добавить договор
     */
    public function actionAddContract(){
        
        $model = new Contract();
        
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $model['Date'] = date("Y-m-d");
			//var_dump($model); exit;
			$model->save();
            return $this->redirect("/main/contract?id=" . $model['Id_contract']);
        }
        else
        {
            if(isset($_GET['id']))
			{
				$model->Id_owner_FK = $_GET['id']; 
			}
			$id = StageOfWorkWithAClient::find()->select('Id_stage_of_work_with_a_client')->column();
			$name = StageOfWorkWithAClient::find()->select('Stage_of_work_with_a_client_name')->column();
			$model->StageOfWork = $this->DropDownMap($id, $name);
			$id = Owner::find()->select('Id_owner')->column();
			$name = Owner::find()->select('Name')->column();
			$model->Owners = $this->DropDownMap($id, $name);
            return $this->render("add-contract", ['model' => $model]);
        }          
    }
	
	/**
	 * Редактировать договор
	 */
	public function actionEditContract()
	{
		$model = new Contract();
        
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $update_model = Contract::findOne($_GET['id']);

            $update_model['Id_contract'] = $_GET['id'];
            $update_model['Number'] = $model['Number'];
            $update_model["Total_cost"] = $model["Total_cost"];
            $update_model["Id_owner_FK"] = $model["Id_owner_FK"];
			$update_model["Id_stage_of_work_with_a_client_FK"] = $model["Id_stage_of_work_with_a_client_FK"];

            $update_model->update();

            return $this->redirect("/main/contract?id=" . $_GET['id']);
        }
        else
		{
            $id = $_GET['id'];
            $model = Contract::findOne($id);

            $id = StageOfWorkWithAClient::find()->select('Id_stage_of_work_with_a_client')->column();
			$name = StageOfWorkWithAClient::find()->select('Stage_of_work_with_a_client_name')->column();
			$model->StageOfWork = $this->DropDownMap($id, $name);
			$id = Owner::find()->select('Id_owner')->column();
			$name = Owner::find()->select('Name')->column();
			$model->Owners = $this->DropDownMap($id, $name);

			return $this->render("edit-contract", ['model' => $model]);
        }
	}
	
	/**
	 * Удаление договора
	 */
	public function actionDeleteContract()
	{
		$id = $_GET['id'];

        $model = Contract::findOne($id);
        $model->delete();

        return $this->redirect("/main/contracts");
	}
	
	/**
	 * Список собственников
	 */
	public function actionOwners()
	{
		return $this->render('owners');
	}
	
    /**
	 * Просмотр данных собственника
	 */
	public function actionOwner()
	{
		$model = Owner::findOne($_GET['id']);
		
		return $this->render('owner', ['model' => $model]);
	}
	
	/**
	 * Добавление собственника
	 */
	public function actionAddOwner()
	{
		$model = new Owner();
        
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
			$model->save();
            return $this->redirect("/main/owner?id=" . $model['Id_owner']);
        }
        else
        {
            $id = OwnerType::find()->select('Id_owner_type')->column();
			$name = OwnerType::find()->select('Owner_type_name')->column();
			$model->Owner_type = $this->DropDownMap($id, $name);
            return $this->render("add-owner", ['model' => $model]);
        }
	}
	
	/**
	 * Изменение собственника
	 */
	public function actionEditOwner()
	{
		$model = new Owner();
        
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $update_model = Owner::findOne($_GET['id']);

            $update_model['Id_owner'] = $_GET['id'];
            $update_model['Name'] = $model['Name'];
            $update_model["Phone_number"] = $model["Phone_number"];
            $update_model["Email"] = $model["Email"];
			$update_model["INN"] = $model["INN"];
			$update_model["Id_owner_type_FK"] = $model["Id_owner_type_FK"];

            $update_model->update();

            return $this->redirect("/main/owner?id=" . $_GET['id']);
        }
        else
		{
            $id = $_GET['id'];
            $model = Owner::findOne($id);

			$id = OwnerType::find()->select('Id_owner_type')->column();
			$name = OwnerType::find()->select('Owner_type_name')->column();
			$model->Owner_type = $this->DropDownMap($id, $name);

			return $this->render("edit-owner", ['model' => $model]);
        }
	}
	
	/**
	 * Удаление собственника
	 */
	public function actionDeleteOwner()
	{
		$id = $_GET['id'];

        $model = Owner::findOne($id);
        $model->delete();
		
		return $this->redirect('owners');
	}
	
	/**
	 * Просмотр списка договоров для добавления к собственниа
	 */
	public function actionAddContractToOwner()
	{
		return $this->render('add-contract-to-owner');
	}
	
	/**
	 * Завершение добавления договора для добавления к собственнику
	 */
	public function actionAddContractToOwnerComplete()
	{
		$Id_contract = $_GET['id'];
        $Id_owner = $_GET['iw'];

        $model = new ContractOfOwners();

        $model->Id_owner_FK = $Id_owner;
        $model->Id_contract_FK = $Id_contract;

        $model->save();

        return $this->redirect("/main/owner?id=" . $_GET['im']);
	}
	
	/**
	 * Открытие списка недвижимости для добавлен к списку у собственника
	 */
	public function actionAddImmovableToOwner()
	{
			return $this->render('add-immovable-to-owner');
	}
	
	/**
	 * Завершение добаление собственности к собственнику 
	 */
	 public function actionAddImmovableToOwnerComplete()
	{
		$Id_immovable = $_GET['id'];
        $Id_owner = $_GET['iw'];

        $model = new ContractOfOwners();

        $model->Id_owner_FK = $Id_owner;
        $model->Id_immovable_FK = $Id_immovable;

        $model->save();

        return $this->redirect("/main/owner?id=" . $_GET['iw']);
	}
	
	/**
	 * Удаление собственности у собственника
	 */
	public function actionDeleteImmovableToOwner()
	{
		$Id_immovable = $_GET['id'];
        $Id_owner = $_GET['iw'];   
        
        $OwnerToDelete = OwnerOfImmovables::find()->where(['Id_immovable_FK' => $Id_immovable, 'Id_owner_FK' => $Id_owner])->one();
        $OwnerToDelete->delete();

        return $this->redirect("/main/owner?id=" . $_GET['iw']);
	}
	
	/**
	 * Удаление договора у собственника
	 */
	public function actionDeleteContractToOwner()
	{
		$model = Contract::findOne($_GET['id']);
		
		$model->delete();
		
		return $this->redirect("/main/owner?id=". $_GET['iw']);
	}
	
	/**
	 * Добавление услуги к договору
	 */
	public function actionAddServiceToContract()
	{
		return $this->render('add-service-to-contract');
	}
	
	/**
	 * Завершение добавления услуги к договору
	 */
	public function actionAddServiceToContractComplete()
	{
		$Id_contract = $_GET['id'];
        $Id_service = $_GET['ic'];

        $model = new ServicesOfContract();

        $model->Id_contract_FK = $Id_contract;
        $model->Id_service_FK = $Id_service;
		$Service = Service::findOne($_GET['ic']);
		$model->Cost = $Service->Cost;

        $model->save();

        return $this->redirect("/main/contract?id=" . $_GET['ic']);
	}
	 
    /**
     * Для генерации отчётов
     */
    public function actionReportGenerate()
    {
        if(Yii::$app->request->isPost)
        {
            $Begin_period = $_POST['Begin_period'];
            $End_period =  $_POST['End_period'];
			
            $result = Zadanie_services::find()->where(['>', 'Date', $Begin_period])->all();  //Дописать условие          

            $writer = new Xlsx($this->GenerateReport($result, $Begin_period, $End_period));
            $FilePath = $Begin_period. "to". $End_period .".xlsx";
            $writer->save("download/" . $FilePath);

            $file = Yii::getAlias("@frontend/web/download/" . $FilePath);
            

            return Yii::$app->response->sendFile($file);      
			
        }
        else 
        {
            return $this->render("report-generate");
        }
    }	

    /**
     * Самописная функция для возвращения значений DropDownList
     */
    public function DropDownMap($id, $name){

        $data = array($id, $name);
        $keys = array_shift($data); 
        $result = array_map(function($v) use($keys){
            return array_combine($keys, $v);
        }, $data);   

        return $result[0];
    }

    /**
     * Генерация отчёта
     */
    public function GenerateReport($data, $Begin_period, $End_period)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->MergeCells('A1:E1');          
        $sheet->setCellValue('A1', "Выгрузка данных за период c " . $Begin_period . " по ". $End_period);
        $sheet->setCellValue('A3','#');
        $sheet->setCellValue('B3','Товар/Услуга');
        $sheet->setCellValue('C3','Количество');
        $sheet->setCellValue('D3','Цена');
        $sheet->setCellValue('E3','Сумма');
        $this->SetBorderThinStyle('A3:E3', $spreadsheet);

        $index = 4;
        $count = 0;
        foreach($data as $d)
        {
            $sheet->setCellValue("A" . $index, $index - 3);
            $sheet->setCellValue("B" . $index, $d->Name);
            $sheet->setCellValue("C" . $index, $d->Count);
            $sheet->setCellValue("D" . $index, $d->Price);
            $formula = "=C".$index."*D".$index;   
            $sheet->setCellValue("E" . $index ,$formula);
            $this->SetBorderThinStyle("A".$index.":E".$index, $spreadsheet);
            $index++;
            $count++;
        }

        $sheet->setCellValue("D".$index, "Итого");
        $cashIndex = $index - 1;
        $formula = "=SUM(E4:E". $cashIndex.")";
        $sheet->setCellValue("E".$index, $formula);
        $total = $sheet->getCell("E".$index)->getCalculatedValue();
        $index++;
        $sheet->setCellValue("D".$index, "В том числе НДС");
        $formula = "=(E".($index - 1) ."/100) * 20";
        $sheet->setCellValue("E".$index, $formula);
        $index += 2;
        
        $sheet->MergeCells("A".$index.":D".$index);
        $sheet->setCellValue("A".$index, "Всего наименований " . $count . " на сумму " . $total . " рублей");
        $index++;
        $sheet->MergeCells("A".$index.":D".$index);
        $sheet->setCellValue("A".$index, $this->ConvertToString($total));
        return $spreadsheet;
    }
    /**
     * функция для присвоения стиля
     */
    public function SetBorderThinStyle($range, $spreadsheet)
    {
        $spreadsheet->getActiveSheet()->getStyle($range)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $spreadsheet->getActiveSheet()->getStyle($range)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $spreadsheet->getActiveSheet()->getStyle($range)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $spreadsheet->getActiveSheet()->getStyle($range)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    /**
     * Перевод из числа в текст
     */
    public function ConvertToString($number) {
	
        static $dic = array(
        
            array(
                -2	=> 'две',
                -1	=> 'одна',
                1	=> 'один',
                2	=> 'два',
                3	=> 'три',
                4	=> 'четыре',
                5	=> 'пять',
                6	=> 'шесть',
                7	=> 'семь',
                8	=> 'восемь',
                9	=> 'девять',
                10	=> 'десять',
                11	=> 'одиннадцать',
                12	=> 'двенадцать',
                13	=> 'тринадцать',
                14	=> 'четырнадцать' ,
                15	=> 'пятнадцать',
                16	=> 'шестнадцать',
                17	=> 'семнадцать',
                18	=> 'восемнадцать',
                19	=> 'девятнадцать',
                20	=> 'двадцать',
                30	=> 'тридцать',
                40	=> 'сорок',
                50	=> 'пятьдесят',
                60	=> 'шестьдесят',
                70	=> 'семьдесят',
                80	=> 'восемьдесят',
                90	=> 'девяносто',
                100	=> 'сто',
                200	=> 'двести',
                300	=> 'триста',
                400	=> 'четыреста',
                500	=> 'пятьсот',
                600	=> 'шестьсот',
                700	=> 'семьсот',
                800	=> 'восемьсот',
                900	=> 'девятьсот'
            ),
            
            array(
                array('рубль', 'рубля', 'рублей'),
                array('тысяча', 'тысячи', 'тысяч'),
                array('миллион', 'миллиона', 'миллионов'),
                array('миллиард', 'миллиарда', 'миллиардов'),
                array('триллион', 'триллиона', 'триллионов'),
                array('квадриллион', 'квадриллиона', 'квадриллионов'),
            ),
            
            array(
                2, 0, 1, 1, 1, 2
            )
        );
        
        $string = array();
        
        $number = str_pad($number, ceil(strlen($number)/3)*3, 0, STR_PAD_LEFT);
        
        $parts = array_reverse(str_split($number,3));
        
        foreach($parts as $i=>$part) {
            
            if($part>0) {
                
                $digits = array();
                
                if($part>99) {
                    $digits[] = floor($part/100)*100;
                }
                
                if($mod1=$part%100) {
                    $mod2 = $part%10;
                    $flag = $i==1 && $mod1!=11 && $mod1!=12 && $mod2<3 ? -1 : 1;
                    if($mod1<20 || !$mod2) {
                        $digits[] = $flag*$mod1;
                    } else {
                        $digits[] = floor($mod1/10)*10;
                        $digits[] = $flag*$mod2;
                    }
                }

                $last = abs(end($digits));
                
                foreach($digits as $j=>$digit) {
                    $digits[$j] = $dic[0][$digit];
                }
                
                $digits[] = $dic[1][$i][(($last%=100)>4 && $last<20) ? 2 : $dic[2][min($last%10,5)]];
                
                array_unshift($string, join(' ', $digits));
            }
        }
        
        return join(' ', $string);
    }
}
?>