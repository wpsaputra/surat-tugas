<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_t_new_kro".
 *
 * @property int $id
 * @property int $tahun
 * @property string $kode
 * @property string $deskripsi
 *
 * @property StSpdNew[] $stSpdNews
 */
class TNewKro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'su_t_new_kro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun'], 'integer'],
            [['deskripsi'], 'string'],
            [['kode'], 'string', 'max' => 100],
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
        return $this->hasMany(StSpdNew::className(), ['kode_kro' => 'id']);
    }
}
