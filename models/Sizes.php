<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sizes".
 *
 * @property integer $id
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
            [['size'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'size' => 'Size',
        ];
    }
}
