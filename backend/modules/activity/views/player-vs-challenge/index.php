<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\frontend\models\Player;
use app\modules\gameplay\models\Challenge;

$this->title="Player vs Target Progress";

?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'challenge_id')->dropDownList(ArrayHelper::map(Challenge::find()->orderBy(['id'=>SORT_ASC])->all(), 'id', 'name'), ['prompt'=>'Select Challenge'])->hint('The challenge for the progress.') ?>

<?= $form->field($model, 'player_id')->dropDownList(ArrayHelper::map(Player::find()->where(['active'=>1])->orderBy(['username'=>SORT_ASC])->all(), 'id', 'username',function($model) { return ucfirst(mb_substr($model->username,0,1)); }), ['prompt'=>'Select player'])->Label('Player')->hint('The player id that the headshot will be given.') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
