<?php
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\helpers\Html;

/**
* @var yii\data\ActiveDataProvider $loginStories
* @var yii\db\ActiveQuery $profile
*/

$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <h2>
        <?= $this->title ?>
    </h2>
    <?= DetailView::widget([
        'model' => $profile,
        'attributes' => [
            [
                'label' => $user->attributeLabels()['username'],
                'value' => $user->username,
            ],
            'name',
            'last_name',
            [
                'label' => $user->attributeLabels()['created_at'],
                'value' => $user->created_at,
                'format' => 'datetime'
            ],
        ],
        ]);
    ?>
</div>

<div class="row">
    <h2>
        <?= Yii::t('user', 'Visits grid') ?>
    </h2>
<?= GridView::widget([
    'dataProvider' => $loginStories,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'login_time:datetime',
    ],
]); ?>
</div>