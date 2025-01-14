<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\frontend\models\PlayerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title=ucfirst(Yii::$app->controller->module->id).' / '.ucfirst(Yii::$app->controller->id);
$this->params['breadcrumbs'][]=['label' => 'Players', 'url' => ['index']];
?>
<div class="player-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Player', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Import Players', ['import'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Reset All player data', ['reset-playdata'], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Are you sure you want to delete all player data?', 'method' => 'post', ]]) ?>
        <?= Html::a('Reset All player progress', ['reset-player-progress'], ['class' => 'btn btn-warning', 'data' => ['confirm' => 'Are you sure you want to delete all player progress?', 'method' => 'post', ]]) ?>
    </p>

    <details>
    <summary>Extended Search</summary>
    <?php  echo $this->render('_search', ['model' => $searchModel]);?>
    </details>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'id',
              'headerOptions' => ['style' => 'width:4em'],
            ],
            [
              'attribute'=>'avatar',
              'format'=>'html',
              'value'=>function($data) { return Html::img('//'.Yii::$app->sys->offense_domain.'/images/avatars/' . $data->profile->avatar,['width' => '50px']);}
            ],

            'username',
            'email:email',
/*            [
              'attribute'=>'type',
              'filter'=>['offense'=>'Offense', 'defense'=>'Defense','both'=>'Both'],
            ],*/
            //'password',
            //'authkey',
            //'accesstoken',
            //'activkey',

            [
              'attribute'=>'on_pui',
              'value'=>function($model) {if($model->last) return $model->last->on_pui == 0 ? null : $model->last->on_pui;else return null;}
            ],
            [
              'attribute'=>'on_vpn',
              'value'=>function($model) {if($model->last) return $model->last->on_vpn == 0 ? null : $model->last->on_vpn;else return null;}
            ],
            [
              'attribute'=>'vpn_local_address',
              'label'=> 'VPN Local IP',
              'value'=>function($model) { return $model->last && $model->last->vpn_local_address ? long2ip($model->last->vpn_local_address) : null;}
            ],
            'online:boolean',
            'active:boolean',
            'academic:boolean',
            'status',
            'created',
            //'ts',
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{generate-ssl} {toggle-academic} '.'{view} {update} {delete} {ban} {mail}',
              'header' => Html::a(
                  '<span class="glyphicon glyphicon-ban-circle"></span>',
                  ['ban-filtered'],
                  [
                      'title' => 'Mass Delete and ban users',
                      'data-pjax' => '0',
                      'data-method' => 'POST',
                      'data'=>[
                        'method'=>'post',
                        'params'=> $searchModel->attributes,
                        'confirm'=>'Are you sure you want to delete and ban the currently filtered users?',
                      ],
                  ]
              ).' '.Html::a(
                  '<span class="glyphicon glyphicon-trash"></span>',
                  ['delete-filtered'],
                  [
                      'title' => 'Mass Delete users',
                      'data-pjax' => '0',
                      'data-method' => 'POST',
                      'data'=>[
                        'method'=>'post',
                        'params'=> $searchModel->attributes,
                        'confirm'=>'Are you sure you want to delete the currently filtered users?',
                      ],
                  ]
              ),
              'buttons' => [
                  'delete' => function($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                          'class' => '',
                          'data' => [
                              'confirm' => 'Are you absolutely sure you want to delete ['.Html::encode($model->username).'] ?',
                              'method' => 'post',
                          ],
                      ]);
                  },
                  'generate-ssl' => function($url) {
                      return Html::a(
                          '<span class="glyphicon glyphicon-lock"></span>',
                          $url,
                          [
                              'title' => 'Generate SSL Certificates',
                              'data-pjax' => '0',
                              'data-method' => 'POST',
                              'data'=>['confirm'=>"Are you sure you want to regenerate the SSL for this user?"]
                          ]
                      );
                  },
                  'toggle-academic' => function($url) {
                      return Html::a(
                          '<span class="glyphicon glyphicon-education"></span>',
                          $url,
                          [
                              'title' => 'Toggle user academic flag',
                              'data-pjax' => '0',
                              'data-method' => 'POST',
                              'data'=>['confirm'=>'Are you sure you want to toggle the academic flag for this user?']

                          ]
                      );
                  },
                  'ban' => function($url) {
                      return Html::a(
                          '<span class="glyphicon glyphicon-ban-circle"></span>',
                          $url,
                          [
                              'title' => 'Delete and ban this user',
                              'data-pjax' => '0',
                              'data-method' => 'POST',
                              'data'=>['confirm'=>'Are you sure you want to delete and ban this user?']
                          ]
                      );
                  },
                  'mail' => function($url) {
                      return Html::a(
                          '<span class="glyphicon glyphicon-envelope"></span>',
                          $url,
                          [
                              'title' => 'Mail this user activation',
                              'data-pjax' => '0',
                              'data-method' => 'POST',
                              'data'=>['confirm'=>'Are you sure you want to mail this user his activation URL?']
                          ]
                      );
                  },
              ],
            ],
        ],
    ]);?>


</div>
