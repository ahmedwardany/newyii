<?php

namespace common\models;
use common\models\User;
use common\models\JobFieldSkill;
use common\models\ticket;
use Yii;

/**
 * This is the model class for table "job_field".
 *
 * @property int $id
 * @property string $name
 * @property int|null $parentId
 * @property int|null $lft
 * @property int|null $rgt
 * @property int|null $depth
 * @property int|null $tree
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $icon
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property JobFieldSkill[] $jobFieldSkills
 * @property Ticket[] $tickets
 */
class JobField extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_field';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parentId', 'lft', 'rgt', 'depth', 'tree', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'icon'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parentId' => 'Parent ID',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'tree' => 'Tree',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'icon' => 'Icon',
        ];
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
     * Gets query for [[JobFieldSkills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobFieldSkills()
    {
        return $this->hasMany(JobFieldSkill::className(), ['fieldId' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['fieldId' => 'id']);
    }
}
