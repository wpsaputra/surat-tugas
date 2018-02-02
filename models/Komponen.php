<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_komponen".
 *
 * @property int $id
 * @property int $kode_komponen
 * @property string $uraian
 * @property int $id_output
 *
 * @property Output $output
 * @property SuratTugas[] $suratTugas
 */
class Komponen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'su_komponen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_komponen', 'id_output'], 'integer'],
            [['uraian'], 'string', 'max' => 118],
            [['id_output'], 'exist', 'skipOnError' => true, 'targetClass' => Output::className(), 'targetAttribute' => ['id_output' => 'kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_komponen' => 'Kode Komponen',
            'uraian' => 'Uraian',
            'id_output' => 'Id Output',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutput()
    {
        return $this->hasOne(Output::className(), ['kode' => 'id_output']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['kode_komponen' => 'id']);
    }
}
