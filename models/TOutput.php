<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%t_output}}".
 *
 * @property int $id
 * @property int $thang
 * @property string $kdgiat
 * @property string $kdoutput
 * @property string $nmoutput
 * @property string $sat
 * @property string $kdsum
 * @property string $thnawal
 * @property string $thnakhir
 * @property string $kdmulti
 * @property string $kdjnsout
 * @property string $kdikk
 * @property string $kdtema
 * @property string $kdpn
 * @property string $kdpp
 * @property string $kdkp
 * @property string $kdproy
 * @property string $kdnawacita
 * @property string $kdjanpres
 * @property string $kdcttout
 */
class TOutput extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%t_output}}';
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
            [['kdoutput'], 'string', 'max' => 3],
            [['nmoutput'], 'string', 'max' => 200],
            [['sat', 'kdsum', 'thnawal', 'thnakhir', 'kdmulti', 'kdjnsout', 'kdikk', 'kdtema', 'kdpn', 'kdpp', 'kdkp', 'kdproy', 'kdnawacita', 'kdjanpres', 'kdcttout'], 'string', 'max' => 10],
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
            'kdoutput' => 'Kdoutput',
            'nmoutput' => 'Nmoutput',
            'sat' => 'Sat',
            'kdsum' => 'Kdsum',
            'thnawal' => 'Thnawal',
            'thnakhir' => 'Thnakhir',
            'kdmulti' => 'Kdmulti',
            'kdjnsout' => 'Kdjnsout',
            'kdikk' => 'Kdikk',
            'kdtema' => 'Kdtema',
            'kdpn' => 'Kdpn',
            'kdpp' => 'Kdpp',
            'kdkp' => 'Kdkp',
            'kdproy' => 'Kdproy',
            'kdnawacita' => 'Kdnawacita',
            'kdjanpres' => 'Kdjanpres',
            'kdcttout' => 'Kdcttout',
        ];
    }
}
