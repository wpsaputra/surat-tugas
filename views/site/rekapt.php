<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\grid\GridView;
use app\models\Instansi;

$this->title = 'Rekapitulasi Tahunan';
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJsFile(
//     '@web/js/highcharts.js',
//     ['depends' => [\yii\web\JqueryAsset::className()]]
// );

// $this->registerJsFile(
//     '@web/js/exporting.js',
//     ['depends' => [\yii\web\JqueryAsset::className()]]
// );

$this->registerJsFile('@web/js/highcharts.js', ['position' => View::POS_HEAD]);
$this->registerJsFile('@web/js/exporting.js', ['position' => View::POS_HEAD]);

// print_r($nama);
// print_r($jumlah);
// print_r($model);
?>
<div class="site-rekapt">
    <div class="row">
        <div class="col-md-6">
            <!-- RECENT PURCHASES -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Rekapitulasi Tahunan <?= '('.Date('Y').')';?></h3>
                    <!-- <div class="right">
                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                        <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                    </div> -->
                </div>
                <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $model,
                    'filterModel' => null,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'NIP',
                        'NAMA',
                        'JABATAN',
                        'JUMLAH',
                        'HARI',
                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 1 year</span></div>
                        <!-- <div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Purchases</a></div> -->
                    </div>
                </div>
            </div>
            <!-- END RECENT PURCHASES -->
        </div>
        <div class="col-md-6">
            <!-- MULTI CHARTS -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Grafik Tahunan</h3>
                    <!-- <div class="right">
                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                        <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                    </div> -->
                </div>
                <div class="panel-body">
                    <!-- <div id="visits-trends-chart" class="ct-chart"></div> -->
                    <div id="chart1" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

                </div>
            </div>
            <!-- END MULTI CHARTS -->
        </div>
    </div>

    
</div>

<script>
// $("#chart1").highcharts({
Highcharts.chart('chart1', {
	chart: {
		type: 'column'
	},
	title: {
		text: <?php echo "'Rekap SPD Pegawai ".Instansi::findOne(Yii::$app->user->identity->id_instansi)->instansi."'"?>
	},
	subtitle: {
		text: <?php echo "'Tahun ".Date('Y')."'"?>
	},
	xAxis: {
		categories: [
		    <?php echo "'" . implode("','", $nama) . "'"; ?>
		],
		crosshair: true
	},
	yAxis: {
		min: 0,
        title: {
            text: 'Jumlah'
        }
	},
	tooltip: {
		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		'<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
		footerFormat: '</table>',
		shared: true,
		useHTML: true
	},
	plotOptions: {
		column: {
		    pointPadding: 0.1,
			borderWidth: 0
		}
	},
	credits: false,
	series: [{
		name: 'Jumlah SPD',
		data: [<?php echo implode(",", $jumlah)?>],
    }]
});


</script>
