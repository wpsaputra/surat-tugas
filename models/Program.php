<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_program".
 *
 * @property string $kode
 * @property string $uraian
 *
 * @property Kegiatan[] $kegiatans
 * @property SuratTugas[] $suratTugas
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'su_program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'uraian'], 'required'],
            [['kode'], 'string', 'max' => 9],
            [['uraian'], 'string', 'max' => 67],
            [['kode'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKegiatans()
    {
        return $this->hasMany(Kegiatan::className(), ['id_prog' => 'kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['kode_program' => 'kode']);
    }
}
