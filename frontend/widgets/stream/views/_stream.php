<?php
use yii\helpers\Html;
use app\widgets\Twitter;
?>
<div class="leader">
    <div class="leader-wrap">
      <div class="leader-name" style="margin-bottom: 0.3em">
         <?=$model->formatted;?>, <?=$model->ts_ago?>
         <?php $model->twitter=true; echo Twitter::widget(['message'=>'Hey check this out '.strip_tags($model->formatted)]);?><!--<?=$model->ts?>-->
      </div>
    </div>
    <div class="border"></div>
</div>
