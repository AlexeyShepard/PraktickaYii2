<?php

namespace app\models;

use yii\db\ActiveRecord;

class Contract extends ActiveRecord
{   
    public $StageOfWork;
	
	public $Owners;
	
	public static function tableName()
    {
        return '{{Contract}}';
    }
	
	public function rules(){
        return [
            [['Number','Total_cost','Id_owner_FK','Id_stage_of_work_with_a_client_FK'], 'required'],
        ];
    }
}

?>