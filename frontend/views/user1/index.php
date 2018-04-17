<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'auth_key',
            'password_hash',
            'password_reset_token',
            //'status',
            //'created_at',
            //'updated_at',
            //'name',
            //'surname',
            //'address',
            //'tambon',
            //'district',
            //'provice',
            //'postcode',
            //'tel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
