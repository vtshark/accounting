<?php

namespace app\models\products;

use app\models\Manufacturers;
use app\models\ProdCategory;
use app\models\ProdNames;
use app\models\Stores;
use app\models\Suppliers;
use app\models\Probe;
use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $name_id
 * @property integer $supplier_id
 * @property integer $manufacturer_id
 * @property integer $store_id
 * @property integer $category_id
 * @property integer $price_sell
 * @property integer $price_procur
 * @property string $art
 * @property double $weight
 * @property double $size
 * @property integer $probe
 * @property integer invoice_procur_id
 * @property integer invoice_transfer_id
 * @property integer invoice_sales_id
 * @property double prime_cost
 *
 * @property ProdNames $prodName
 * @property Suppliers $supplier
 * @property Manufacturers $manufacturer
 * @property Stores $store
 * @property ProdCategory $category
 */
class Products extends \yii\db\ActiveRecord
{
    const SCENARIO_ADD_PRODUCT = 'add_product';
    const SCENARIO_APPROVE_INVOICE = 'approve_invoice';

    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_id', 'supplier_id', 'manufacturer_id', 'store_id', 'category_id', 'price_sell',
                'invoice_procur_id', 'invoice_transfer_id', 'invoice_sales_id','probe'],
                'integer'],
            [['weight', 'price_procur', 'size'], 'double'],
            [['prime_cost'], 'double', 'on' => self::SCENARIO_APPROVE_INVOICE],
            [['art'], 'string', 'max' => 255],
            [['name_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProdNames::className(), 'targetAttribute' => ['name_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['supplier_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturers::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['store_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProdCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['probe'], 'exist', 'skipOnError' => true, 'targetClass' => Probe::className(), 'targetAttribute' => ['probe' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_id' => 'Наименование',
            'supplier_id' => 'Поставщик',
            'manufacturer_id' => 'Изготовитель',
            'store_id' => 'Филиал',
            'art' => 'Артикул',
            'category_id' => 'Категория',
            'weight' => 'Вес',
            'price_sell' => 'Цена продажи',
            'price_procur' => 'Цена закупки',
            'invoice_procur_id' => 'Накладная закупки',
            'probe' => 'Проба',
            'size' => 'Размер',
            'prime_cost' => 'Себестоимость'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdName()
    {
        return $this->hasOne(ProdNames::className(), ['id' => 'name_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Suppliers::className(), ['id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturers::className(), ['id' => 'manufacturer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'store_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(ProdCategory::className(), ['id' => 'category_id']);
    }
}
