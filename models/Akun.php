<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%akun}}".
 *
 * @property int $id
 * @property string $uraian
 *
 * @property StSpd[] $stSpds
 * @property SuratTugas[] $suratTugas
 */
class Akun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%akun}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['uraian'], 'string', 'max' => 35],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStSpds()
    {
        return $this->hasMany(StSpd::className(), ['id_akun' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['id_akun' => 'id']);
    }
}
