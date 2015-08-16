
<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fakta */
/* @var $form yii\widgets\ActiveForm */
?>
<table class="table table-striped table-y-border">

<thead>
<tr>
<th>Nama Wilayah</th>
<th>Tahun</th>
<th>Nilai</th>
</tr>
</thead>
<tbody>
<?php

if($tabel!=null){
foreach ($tabel as $baris) {
echo '<tr>';
echo '<td>'.$baris['nama_wilayah'].'</td>';
echo '<td>'.$baris['tahun'].'</td>';
echo '<td>'.$baris['nilai'].'</td>';
echo '</tr>';
}
}
?>
</tbody>
</table>
