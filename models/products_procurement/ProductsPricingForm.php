<?php
namespace app\models\products_procurement;

use Yii;
use yii\base\Model;


class ProductsPricingForm extends Model
{

    public $pricing_method;
    public $procurement_id;
    public $coefficient;
    private static $pricing_methods = [
        0 => "Закупка * коеф.",
        1 => "вес * коэф.",
    ];


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['pricing_method', 'procurement_id', 'coefficient'], 'required'],
            [['pricing_method', 'procurement_id'], 'integer'],
            [['coefficient'], 'double'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'pricing_method' => 'Метод наценки',
            'coefficient' => 'Коефициент',
        ];
    }

    public static function getPricingMethods() {
        return static::$pricing_methods;
    }

}
