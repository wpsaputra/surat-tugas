<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_kegiatan".
 *
 * @property int $kode
 * @property string $uraian
 * @property string $id_prog
 *
 * @property Program $prog
 * @property Output[] $outputs
 * @property SuratTugas[] $suratTugas
 */
class Kegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'su_kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'uraian', 'id_prog'], 'required'],
            [['kode'], 'integer'],
            [['uraian'], 'string', 'max' => 68],
            [['id_prog'], 'string', 'max' => 9],
            [['kode'], 'unique'],
            [['id_prog'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['id_prog' => 'kode']],
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
            'id_prog' => 'Id Prog',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProg()
    {
        return $this->hasOne(Program::className(), ['kode' => 'id_prog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutputs()
    {
        return $this->hasMany(Output::className(), ['id_kegiatan' => 'kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['kode_kegiatan' => 'kode']);
    }
}
