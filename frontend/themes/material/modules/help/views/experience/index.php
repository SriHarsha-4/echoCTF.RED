<?php
use yii\helpers\Html;
use yii\widgets\ListView;
$this->title=Html::encode(Yii::$app->sys->event_name.' Experience Levels');
$this->_description='Experience levels and their requirements in points';
$this->_url=\yii\helpers\Url::to(['index'], 'https');
use app\components\formatters\Anchor;
?>
<div class="faq-index">
  <div class="body-content">
    <h2><?=Html::encode($this->title)?></h2>
      The experience levels and their point ranges.
    <hr />
    <?php if(intval($dataProvider->getCount())>0):?>
      <h4>Table of Contents</h4>
      <ol>
      <?php foreach($dataProvider->getModels() as $entry):?>
        <li><?=Html::a(Html::encode($entry->name),'#'.Html::encode(Anchor::to($entry->name)));?></li>
      <?php endforeach;?>
      </ol>
    <?php endif;?>
    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'emptyText'=>'<p class="text-info"><b>No experience entries exist at the moment...</b></p>',
        'summary'=>false,
        'itemOptions' => [
          'tag' => false
        ],
        'itemView' => '_item',
    ]);?>
  </div>
</div>
