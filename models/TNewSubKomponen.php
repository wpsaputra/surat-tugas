<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_t_new_sub_komponen".
 *
 * @property int $id
 * @property int $tahun
 * @property string $kode
 * @property string $deskripsi
 *
 * @property StSpdNew[] $stSpdNews
 */
class TNewSubKomponen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'su_t_new_sub_komponen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'tahun'], 'integer'],
            [['deskripsi'], 'string'],
            [['kode'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'kode' => 'Kode',
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStSpdNews()
    {
        return $this->hasMany(StSpdNew::className(), ['kode_subkomponen' => 'id']);
    }
}
