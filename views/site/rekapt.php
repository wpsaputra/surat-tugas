<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\grid\GridView;
use app\models\Instansi;
use kartik\date\DatePicker;
use yii\bootstrap\Dropdown;

$this->title = 'Rekapitulasi Tahunan';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/highcharts.js', ['position' => View::POS_HEAD]);
$this->registerJsFile('@web/js/exporting.js', ['position' => View::POS_HEAD]);

$js = '$(".date").on("change", function() {
    var date = $(this).val();
    if(date.length>0){
        // var url      = window.location.href.split("&year=");
        var url      = window.location.href.split("?year=");
        console.log(date);
        // console.log(link);
        // window.location = "index.php";
        // window.location = window.location.href + "&month=" + arr_date[0] + "&year=" + arr_date[1];
        // window.location = url[0] + "&year=" + date;
        window.location = url[0] + "?year=" + date;

    }


});';

$this->registerJS($js);

?>
<div class="site-rekapt">
    <div class='row'>
        <div class='col-md-12'>
            <div style='width:300px;' class='pull-right'>
                <?php
                    echo DatePicker::widget([
                        'name' => 'check_issue_date', 
                        'value' => $year,
                        // 'type' => DatePicker::TYPE_INPUT,
                        'options' => ['placeholder' => 'Pilih bulan & tahun rekapitulasi ...', 'class'=>'date'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'startView'=>'year',
                            'minViewMode'=>'years',
                            'format' => 'yyyy'
                        ]
                    ]);
                ?>
            </div>
        </div>
        <br/>
        <br/>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- RECENT PURCHASES -->
            <div class="panel">
                <div class="panel-heading">
                    <!-- <h3 class="panel-title">Rekapitulasi Tahunan <?= '('.$year.')';?></h3> -->
                    <!-- <div class="right">
                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                        <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                    </div> -->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="panel-title">Rekapitulasi Tahunan <?= '('.$year.')';?></h3>
                        </div>
                        <div class="col-sm-6">
                        <?= Html::dropDownList('s_id', null,
                            [
                                0=>"Surat Tugas Akun Belanja Perjalanan Dinas Biasa (524111)", 
                                1=>"Surat Tugas Akun Belanja Perjalanan Dinas Dalam Kota (524113)",
                                2=>"Surat Tugas Semua Akun (52411 & 524113)"
                            ],
                            ['prompt'=>'Pilih jenis surat tugas ...', 'class'=>'form-control pull-right'],
                            )
                        ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div style="overflow: auto; overflow-y: hidden; Height:?">
                        <?= GridView::widget([
                            'dataProvider' => $model,
                            'filterModel' => null,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'NIP',
                                'NAMA',
                                'JABATAN',
                                // 'JUMLAH',
                                [
                                    'label' => 'Jumlah SPD',
                                    'attribute' => 'JUMLAH',
                                ],
                                'HARI',
                                // ['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                    </div>
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
		text: <?php echo "'Tahun ".$year."'"?>
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
