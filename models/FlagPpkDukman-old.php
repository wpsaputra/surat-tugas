<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_flag_ppk_dukman".
 *
 * @property int $id
 * @property int $nip
 * @property int $id_instansi
 */
class FlagPpkDukman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'su_flag_ppk_dukman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'id_instansi'], 'required'],
            [['nip', 'id_instansi'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'id_instansi' => 'Id Instansi',
        ];
    }
}
