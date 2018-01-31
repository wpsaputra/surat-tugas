<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%flag_kepala}}".
 *
 * @property int $id
 * @property string $nip
 * @property int $id_instansi
 *
 * @property Pegawai $nip0
 * @property Instansi $instansi
 */
class FlagKepala extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const SCENARIO_ADMIN = 'admin';
    
    public static function tableName()
    {
        return '{{%flag_kepala}}';
    }

    public function behaviors() {
        
        return [
            "auto_fill_instansi_with_user"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'id_instansi',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'id_instansi',
                ],
                'value' => function ($event) {
                    return Yii::$app->user->identity->id_instansi;
                },
            ],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip'], 'required'],
            [['nip', 'id_instansi'], 'integer'],
            [['nip'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip' => 'nip']],
            [['id_instansi'], 'exist', 'skipOnError' => true, 'targetClass' => Instansi::className(), 'targetAttribute' => ['id_instansi' => 'id']],
            // custom
            [['id_instansi'], 'required', 'on'=>self::SCENARIO_ADMIN],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'id_instansi' => 'Id Instansi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNip0()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstansi()
    {
        return $this->hasOne(Instansi::className(), ['id' => 'id_instansi']);
    }
}
