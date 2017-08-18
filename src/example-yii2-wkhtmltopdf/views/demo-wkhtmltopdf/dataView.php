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
<h2>Test measure unit</h2>
<table class="table-bordered">
  <colgroup>
      <col style="width: 1cm;" />
      <col style="width: 2cm;" />
      <col style="width: 3cm;" />
      <col style="width: 4cm;" />
      <col style="width: 5cm;" />
  </colgroup>
  <tr>
      <td>Col 1</td>
      <td>Col 2</td>
      <td>Col 3</td>
      <td>Col 4</td>
      <td>Col 5</td>
  </tr>
</table>