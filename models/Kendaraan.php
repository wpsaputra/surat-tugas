<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%kendaraan}}".
 *
 * @property int $id
 * @property string $nama_kendaraan
 *
 * @property StSpd[] $stSpds
 * @property SuratTugas[] $suratTugas
 */
class Kendaraan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kendaraan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_kendaraan'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_kendaraan' => 'Nama Kendaraan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStSpds()
    {
        return $this->hasMany(StSpd::className(), ['id_kendaraan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['id_kendaraan' => 'id']);
    }
}
