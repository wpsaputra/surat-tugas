<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%t_program}}".
 *
 * @property int $id
 * @property int $thang
 * @property string $kddept
 * @property string $kdunit
 * @property string $kdprogram
 * @property string $nmprogram
 * @property string $kdupdate
 * @property string $updater
 * @property string $tglupdate
 * @property string $pjjabatan
 * @property string $pjnama
 * @property string $pjnip
 */
class TProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%t_program}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'thang'], 'integer'],
            [['kddept'], 'string', 'max' => 3],
            [['kdunit', 'kdprogram'], 'string', 'max' => 2],
            [['nmprogram'], 'string', 'max' => 150],
            [['kdupdate', 'updater', 'tglupdate', 'pjjabatan', 'pjnama', 'pjnip'], 'string', 'max' => 10],
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
            'thang' => 'Thang',
            'kddept' => 'Kddept',
            'kdunit' => 'Kdunit',
            'kdprogram' => 'Kdprogram',
            'nmprogram' => 'Nmprogram',
            'kdupdate' => 'Kdupdate',
            'updater' => 'Updater',
            'tglupdate' => 'Tglupdate',
            'pjjabatan' => 'Pjjabatan',
            'pjnama' => 'Pjnama',
            'pjnip' => 'Pjnip',
        ];
    }
}
