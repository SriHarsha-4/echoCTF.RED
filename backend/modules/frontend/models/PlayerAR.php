<?php

namespace app\modules\frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use app\modules\activity\models\PlayerQuestion;
use app\modules\activity\models\PlayerTreasure;
use app\modules\activity\models\SpinQueue;
use app\modules\activity\models\SpinHistory;
use app\modules\activity\models\Report;
use app\modules\activity\models\Stream;
use app\modules\gameplay\models\Hint;
use app\modules\gameplay\models\Finding;
use app\modules\gameplay\models\Treasure;

/**
 * This is the model class for table "player".
 *
 * @property int $id
 * @property string $username
 * @property string $fullname
 * @property string $email
 * @property string $type
 * @property string $password
 * @property string $password_hash
 * @property string $activkey
 * @property string $auth_key
 * @property int $created
 * @property int $active
 * @property int $academic
 * @property int $status
 * @property string $ts
 *
 * @property PlayerBadge[] $playerBadges
 * @property Badge[] $badges
 * @property PlayerFinding[] $playerFindings
 * @property Finding[] $findings
 * @property PlayerHint[] $playerHints
 * @property Hint[] $hints
 * @property PlayerIp[] $playerIp
 * @property PlayerIp[] $playerIps
 * @property PlayerMac[] $playerMacs
 * @property PlayerQuestion[] $playerQuestions
 * @property PlayerTreasure[] $playerTreasures
 * @property Treasure[] $treasures
 * @property Report[] $reports
 * @property Sessions[] $sessions
 * @property Sshkey $sshkey
 * @property Stream[] $streams
 * @property Team[] $teams
 * @property TeamPlayer $teamPlayer
 * @property Team[] $team
 * @property Profile[] $profile
 * @property PlayerSsl[] $playerSsl
 */
class PlayerAR extends \yii\db\ActiveRecord
{
  public $ovpn=null, $online=null, $last_seen=null;
  public $new_password;
  const STATUS_DELETED=0;
  const STATUS_UNVERIFIED=8;
  const STATUS_INACTIVE=9;
  const STATUS_ACTIVE=10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player';
    }
    public function behaviors()
    {
      return [
          [
              'class' => TimestampBehavior::class,
              'createdAtAttribute' => 'created',
              'updatedAtAttribute' => 'ts',
              'value' => new Expression('NOW()'),
          ],
      ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'type', 'status'], 'required'],
            [['type'], 'string'],
            [['active', 'status'], 'integer'],
            [['academic'], 'boolean'],
            [['email'], 'filter', 'filter'=>'strtolower'],
            [['activkey'], 'string', 'max' => 32],
            [['auth_key'], 'string', 'max' => 32],
            [['type'], 'default', 'value' => 'offense'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['activkey'], 'default', 'value' => Yii::$app->security->generateRandomString().'_'.time(), 'on' => 'create'],
            [['username', 'fullname', 'email', 'new_password', 'activkey'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['new_password', 'password'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'type' => 'Type',
            'password' => 'Password',
            'activkey' => 'Activkey',
            'created' => 'Created',
            'active' => 'Active',
            'academic' => 'Academic',
            'status'=>'Status',
            'ts' => 'Ts',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerBadges()
    {
        return $this->hasMany(\app\modules\activity\models\PlayerBadge::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBadges()
    {
        return $this->hasMany(\app\modules\gameplay\models\Badge::class, ['id' => 'badge_id'])->viaTable('player_badge', ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerFindings()
    {
        return $this->hasMany(\app\modules\activity\models\PlayerFinding::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFindings()
    {
        return $this->hasMany(Finding::class, ['id' => 'finding_id'])->viaTable('player_finding', ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerHints()
    {
        return $this->hasMany(\app\modules\activity\models\PlayerHint::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHints()
    {
        return $this->hasMany(Hint::class, ['id' => 'hint_id'])->viaTable('player_hint', ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerIp()
    {
        return $this->hasOne(PlayerIp::class, ['player_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerIps()
    {
        return $this->hasMany(PlayerIp::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerSsl()
    {
        return $this->hasOne(PlayerSsl::class, ['player_id' => 'id']);
    }

    public function getPlayerSpin()
    {
        return $this->hasOne(PlayerSpin::class, ['player_id' => 'id']);
    }

    public function getSpinQueue()
    {
        return $this->hasMany(SpinQueue::class, ['player_id' => 'id']);
    }

    public function getSpinHistory()
    {
        return $this->hasMany(\app\modules\activity\models\SpinHistory::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerQuestions()
    {
        return $this->hasMany(PlayerQuestion::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerTreasures()
    {
        return $this->hasMany(PlayerTreasure::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreasures()
    {
        return $this->hasMany(Treasure::class, ['id' => 'treasure_id'])->viaTable('player_treasure', ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(\app\modules\activity\models\Sessions::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getSshkey()
//    {
//        return $this->hasOne(Sshkey::class, ['player_id' => 'id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreams()
    {
        return $this->hasMany(Stream::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::class, ['owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamPlayer()
    {
        return $this->hasOne(TeamPlayer::class, ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLast()
    {
        return $this->hasOne(\app\modules\activity\models\PlayerLast::class, ['id' => 'id']);
    }

    public function beforeSave($insert)
    {
      if($this->auth_key == "")
      {
          $this->auth_key=Yii::$app->security->generateRandomString();
      }

      if($this->new_password != "")
      {
        $this->password_hash=Yii::$app->security->generatePasswordHash($this->new_password);
        $this->password=Yii::$app->security->generatePasswordHash($this->new_password);
      }

      return parent::beforeSave($insert);
    }

  /*  public function getOvpn()
    {
      $ip=Yii::$app->cache->Memcache->get("ovpn:".$this->id);
      if($ip===false) return long2ip(0);
      return $ip;
    }

    public function getLast_seen()
    {
      $last_seen=Yii::$app->cache->Memcache->get("last_seen:".$this->id);
      if($last_seen===false) $last_seen=null;
      return $last_seen;
    }

    public function getOnPUI()
    {
      return Yii::$app->cache->Memcache->get("online:".$this->id);
    }*/

    public static function find()
    {
      return parent::find()->select(['player.*', 'ifnull(memc_get(concat("ovpn:",player.id)),0) as ovpn', 'ifnull(memc_get(concat("online:",player.id)),0) as online', 'memc_get(concat("last_seen:",player.id)) as last_seen']);
    }

    public function getHeadshots() {
      $QUERY="SELECT t.* FROM target AS t left join treasure as t2 on t2.target_id=t.id left join finding as t3 on t3.target_id=t.id LEFT JOIN player_treasure as t4 on t4.treasure_id=t2.id and t4.player_id=:player_id left join player_finding as t5 on t5.finding_id=t3.id and t5.player_id=:player_id GROUP BY t.id HAVING count(distinct t2.id)=count(distinct t4.treasure_id) AND count(distinct t3.id)=count(distinct t5.finding_id) ORDER BY t.ip,t.fqdn,t.name";
      $targets=Yii::$app->db->createCommand($QUERY, [':player_id'=>$this->id])->queryAll();
      return $targets;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }


}
