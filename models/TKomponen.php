<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%t_komponen}}".
 *
 * @property int $id
 * @property int $thang
 * @property string $kddept
 * @property string $kdunit
 * @property string $kdprogram
 * @property string $kdgiat
 * @property string $kdoutput
 * @property string $kdsoutput
 * @property string $kdkmpnen
 * @property string $nmkmpnen
 * @property string $n1
 * @property string $n2
 * @property string $n3
 * @property string $n4
 * @property string $indekskali
 * @property string $indeksout
 */
class TKomponen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%t_komponen}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'thang'], 'integer'],
            [['kddept', 'kdoutput', 'kdsoutput', 'kdkmpnen'], 'string', 'max' => 3],
            [['kdunit', 'kdprogram'], 'string', 'max' => 2],
            [['kdgiat'], 'string', 'max' => 4],
            [['nmkmpnen'], 'string', 'max' => 200],
            [['n1', 'n2', 'n3', 'n4', 'indekskali', 'indeksout'], 'string', 'max' => 10],
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
            'kdgiat' => 'Kdgiat',
            'kdoutput' => 'Kdoutput',
            'kdsoutput' => 'Kdsoutput',
            'kdkmpnen' => 'Kdkmpnen',
            'nmkmpnen' => 'Nmkmpnen',
            'n1' => 'N1',
            'n2' => 'N2',
            'n3' => 'N3',
            'n4' => 'N4',
            'indekskali' => 'Indekskali',
            'indeksout' => 'Indeksout',
        ];
    }
}
