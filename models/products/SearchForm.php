<?php
namespace app\models\products;

class SearchForm extends \yii\base\Model
{
    public $id;
    public $store_id;
    public $name_id;
    public $art;
    public $category_id;
    public $supplier_id;
    public $weight;
    public $price_sell;
    public $size;

    public function rules()
    {
        return [
            [['id', 'store_id', 'name_id', 'category_id', 'supplier_id'], 'integer'],
            [['art'], 'string', 'max' => 255],
            [['weight', 'price_sell', 'size'], 'double'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Филиал',
            'name_id' => 'Наименование',
            'art' => 'Артикул',
            'category_id' => 'Категория',
            'supplier_id' => 'Поставщик',
            'weight' => 'Вес',
            'price_sell' => 'Цена продажи',
            'size' => 'Размер',
        ];
    }

}