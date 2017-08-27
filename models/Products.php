<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $name_id
 * @property integer $supplier_id
 * @property integer $manufacturer_id
 * @property integer $branch_id
 * @property integer $size_id
 * @property integer $category_id
 * @property integer $price_sell
 * @property integer $price_procur
 * @property string $art
 *
 * @property ProdNames $name
 * @property Suppliers $supplier
 * @property Manufacturers $manufacturer
 * @property Branches $branch
 * @property Sizes $size
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['name_id', 'supplier_id', 'manufacturer_id', 'branch_id', 'size_id', 'price_sell'], 'integer'],
            [['weight', 'price_procur'], 'double'],
            [['art'], 'string'],
            [['name_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProdNames::className(), 'targetAttribute' => ['name_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['supplier_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturers::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['size_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sizes::className(), 'targetAttribute' => ['size_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProdCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['invoice_procur_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvoiceProcurement::className(), 'targetAttribute' => ['invoice_procur_id' => 'id']],
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
            'branch_id' => 'Филиал',
            'size_id' => 'Размер',
            'price_sell' => 'Цена продажи',
            'price_procur' => 'Цена закупки',
            'art' => 'Артикул',
            'category_id' => 'Категория',
            'weight' => 'Вес',
            'invoice_procur_id' => '№ закупки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName()
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
    public function getBranch()
    {
        return $this->hasOne(Branches::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSize()
    {
        return $this->hasOne(Sizes::className(), ['id' => 'size_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(ProdCategory::className(), ['id' => 'category_id']);
    }
}
