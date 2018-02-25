<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Suppliers".
 *
 * @property integer $id
 * @property string $name_full
 * @property string $name_short
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_full'], 'string', 'max' => 255],
            [['name_short'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_full' => 'Name Full',
            'name_short' => 'Name Short',
        ];
    }
}
