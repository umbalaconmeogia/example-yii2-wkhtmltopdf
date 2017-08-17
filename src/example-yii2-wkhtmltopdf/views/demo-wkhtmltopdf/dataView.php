<?php
use yii\grid\GridView;

/* @var $this yii\web\View */
?>
<div style="border: 1px solid silver; padding: 10px;">
    <h1>データ一覧</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'age',
            'height',
        ],
    ]); ?>
</div>