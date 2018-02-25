<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%instansi}}".
 *
 * @property int $id
 * @property string $instansi
 * @property string $alamat
 * @property string $telepon
 * @property string $fax
 * @property string $email
 * @property string $homepage
 * @property int $id_spd
 * @property int $unit_kerja
 *
 * @property FlagBendahara[] $flagBendaharas
 * @property FlagKepala[] $flagKepalas
 * @property FlagPpk[] $flagPpks
 * @property Pegawai[] $pegawais
 * @property StSpd[] $stSpds
 * @property SuratTugas[] $suratTugas
 */
class Instansi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%instansi}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'unit_kerja'], 'required'],
            [['id', 'id_spd', 'unit_kerja'], 'integer'],
            [['instansi', 'homepage'], 'string', 'max' => 30],
            [['alamat'], 'string', 'max' => 82],
            [['telepon'], 'string', 'max' => 22],
            [['fax'], 'string', 'max' => 14],
            [['email'], 'string', 'max' => 17],
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
            'instansi' => 'Instansi',
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
            'fax' => 'Fax',
            'email' => 'Email',
            'homepage' => 'Homepage',
            'id_spd' => 'Id Spd',
            'unit_kerja' => 'Unit Kerja',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlagBendaharas()
    {
        return $this->hasMany(FlagBendahara::className(), ['id_instansi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlagKepalas()
    {
        return $this->hasMany(FlagKepala::className(), ['id_instansi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlagPpks()
    {
        return $this->hasMany(FlagPpk::className(), ['id_instansi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawais()
    {
        return $this->hasMany(Pegawai::className(), ['id_instansi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStSpds()
    {
        return $this->hasMany(StSpd::className(), ['id_instansi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['id_instansi' => 'id']);
    }
}
