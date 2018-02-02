<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_output".
 *
 * @property int $kode
 * @property string $uraian
 * @property int $id_kegiatan
 *
 * @property Komponen[] $komponens
 * @property Kegiatan $kegiatan
 * @property SuratTugas[] $suratTugas
 */
class Output extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'su_output';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode'], 'required'],
            [['kode', 'id_kegiatan'], 'integer'],
            [['uraian'], 'string', 'max' => 101],
            [['kode'], 'unique'],
            [['id_kegiatan'], 'exist', 'skipOnError' => true, 'targetClass' => Kegiatan::className(), 'targetAttribute' => ['id_kegiatan' => 'kode']],
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
            'id_kegiatan' => 'Id Kegiatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomponens()
    {
        return $this->hasMany(Komponen::className(), ['id_output' => 'kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKegiatan()
    {
        return $this->hasOne(Kegiatan::className(), ['kode' => 'id_kegiatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['kode_output' => 'kode']);
    }
}
