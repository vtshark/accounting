<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sizes".
 *
 * @property double $size
 */
class Sizes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sizes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size'], 'required'],
            [['size'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'size' => 'Size',
        ];
    }

    public static function getAll() {
        return self::find()->asArray()->all();
    }
}
