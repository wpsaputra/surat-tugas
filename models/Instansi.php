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
 *
 * @property Pegawai[] $pegawais
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
            [['id'], 'required'],
            [['id', 'id_spd'], 'integer'],
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
        ];
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
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['id_instansi' => 'id']);
    }
}
