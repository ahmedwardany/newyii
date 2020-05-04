<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property int $fieldId
 * @property int $yearsOfExperience
 * @property int $role 1 seeker, 2 employer
 * @property int|null $languageId
 * @property int|null $status 0 for expired, 1 for ready, 2 for assigned, 3 for busy, 4 for hold
 * @property int|null $isDeleted 0 for not deleted, 1 for deleted
 * @property int|null $isDisabled 0 for enabled, 1 for disabled only done by admin
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $disabled_at
 * @property int|null $disabled_by
 *
 * @property Interview[] $interviews
 * @property Interview[] $interviews0
 * @property User $createdBy
 * @property User $disabledBy
 * @property JobField $field
 * @property User $updatedBy
 * @property Language $language
 * @property TicketSlot[] $ticketSlots
 */
class ticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fieldId', 'yearsOfExperience', 'role'], 'required'],
            [['fieldId', 'yearsOfExperience', 'role', 'languageId', 'status', 'isDeleted', 'isDisabled', 'created_at', 'updated_at', 'created_by', 'updated_by', 'disabled_at', 'disabled_by'], 'integer'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['disabled_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['disabled_by' => 'id']],
            [['fieldId'], 'exist', 'skipOnError' => true, 'targetClass' => JobField::className(), 'targetAttribute' => ['fieldId' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['languageId' => 'id']],
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
            'yearsOfExperience' => 'Years Of Experience',
            'role' => 'Role',
            'languageId' => 'Language ID',
            'status' => 'Status',
            'isDeleted' => 'Is Deleted',
            'isDisabled' => 'Is Disabled',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'disabled_at' => 'Disabled At',
            'disabled_by' => 'Disabled By',
        ];
    }

    /**
     * Gets query for [[Interviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterviews()
    {
        return $this->hasMany(Interview::className(), ['employerticketId' => 'id']);
    }

    /**
     * Gets query for [[Interviews0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterviews0()
    {
        return $this->hasMany(Interview::className(), ['seekerticketId' => 'id']);
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
     * Gets query for [[DisabledBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisabledBy()
    {
        return $this->hasOne(User::className(), ['id' => 'disabled_by']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'languageId']);
    }

    /**
     * Gets query for [[TicketSlots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketSlots()
    {
        return $this->hasMany(TicketSlot::className(), ['ticketId' => 'id']);
    }
}
