<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_field_skill".
 *
 * @property int $id
 * @property int|null $fieldId
 * @property int|null $skillId
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Skill $skill
 * @property User $createdBy
 * @property User $updatedBy
 * @property JobField $field
 * @property Question[] $questions
 */
class JobFieldSkill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_field_skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fieldId', 'skillId', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['skillId'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['skillId' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['fieldId'], 'exist', 'skipOnError' => true, 'targetClass' => JobField::className(), 'targetAttribute' => ['fieldId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fieldId' => 'Field ID',
            'skillId' => 'Skill ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Skill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id' => 'skillId']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Field]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(JobField::className(), ['id' => 'fieldId']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['skillfieldId' => 'id']);
    }
}
