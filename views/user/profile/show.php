<?php
use yii\grid\GridView;
use yii\widgets\DetailView;

/**
* @var yii\data\ActiveDataProvider $loginStories
* @var yii\db\ActiveQuery $profile
*/

?>

<div class="row">
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
    <div class="panel-heading">
        <?= Yii::t('user', 'Visits grid') ?>
</div>
<?= GridView::widget([
    'dataProvider' => $loginStories,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'login_time:datetime',
    ],
]); ?>
</div>