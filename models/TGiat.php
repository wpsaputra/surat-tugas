<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%t_giat}}".
 *
 * @property int $id
 * @property int $thang
 * @property string $kdgiat
 * @property string $nmgiat
 * @property string $kddept
 * @property string $kdunit
 * @property string $kdprogram
 * @property string $kdfungsi
 * @property string $kdsfung
 * @property string $kdes2
 */
class TGiat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%t_giat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'thang'], 'integer'],
            [['kdgiat'], 'string', 'max' => 4],
            [['nmgiat'], 'string', 'max' => 200],
            [['kddept'], 'string', 'max' => 3],
            [['kdunit', 'kdprogram', 'kdfungsi', 'kdsfung', 'kdes2'], 'string', 'max' => 2],
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
            'kdgiat' => 'Kdgiat',
            'nmgiat' => 'Nmgiat',
            'kddept' => 'Kddept',
            'kdunit' => 'Kdunit',
            'kdprogram' => 'Kdprogram',
            'kdfungsi' => 'Kdfungsi',
            'kdsfung' => 'Kdsfung',
            'kdes2' => 'Kdes2',
        ];
    }
}
