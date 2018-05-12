<?php

namespace app\models\products_procurement;

use yii\base\Model;

class ApproveInvoiceForm extends Model
{
    public $dollar_rate;
    public $procurement_id;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['procurement_id', 'dollar_rate'], 'required'],
            [['procurement_id'], 'integer'],
            [['dollar_rate'], 'double' , 'min' => 0.01],
        ];
    }

    public function attributeLabels()
    {
        return [
            'dollar_rate' => 'Курс $',
        ];
    }

}