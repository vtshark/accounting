<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prod_names".
 *
 * @property integer $id
 * @property string $name
 */
class ProdNames extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prod_names';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function getAll() {
        return self::find()->asArray()->all();
    }
}
