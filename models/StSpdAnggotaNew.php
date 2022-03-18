<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_st_spd_anggota_new".
 *
 * @property int $id
 * @property int $nip_anggota
 * @property string $nomor_spd
 * @property int $id_st_spd
 *
 * @property Pegawai $nipAnggota
 * @property StSpdNew $stSpd
 */
class StSpdAnggotaNew extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'su_st_spd_anggota_new';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip_anggota', 'nomor_spd', 'id_st_spd'], 'required'],
            [['nip_anggota', 'id_st_spd'], 'integer'],
            [['nomor_spd'], 'string', 'max' => 120],
            [['nomor_spd'], 'unique'],
            [['nip_anggota'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip_anggota' => 'nip']],
            [['id_st_spd'], 'exist', 'skipOnError' => true, 'targetClass' => StSpdNew::className(), 'targetAttribute' => ['id_st_spd' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip_anggota' => 'Nip Anggota',
            'nomor_spd' => 'Nomor Spd',
            'id_st_spd' => 'Id St Spd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNipAnggota()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip_anggota']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStSpd()
    {
        return $this->hasOne(StSpdNew::className(), ['id' => 'id_st_spd']);
    }
}
