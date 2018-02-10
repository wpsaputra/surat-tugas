<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%template_new}}".
 *
 * @property int $id
 * @property string $nama
 * @property string $html_text
 */
class TemplateNew extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%template_new}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'html_text'], 'required'],
            [['html_text'], 'string'],
            [['nama'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'html_text' => 'Html Text',
        ];
    }
}
