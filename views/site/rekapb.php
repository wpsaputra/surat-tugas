<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\grid\GridView;
use app\models\Instansi;
use kartik\date\DatePicker;

$this->title = 'Rekapitulasi Bulanan';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/highcharts.js', ['position' => View::POS_HEAD]);
$this->registerJsFile('@web/js/exporting.js', ['position' => View::POS_HEAD]);

$js = '$(".date").on("change", function() {
    var arr_date = $(this).val().split(" ");
    if(arr_date.length>1){
        // var url      = window.location.href.split("&month=");
        var url      = window.location.href.split("?month=");
        console.log(arr_date);
        
        // window.location = "index.php";
        // window.location = window.location.href + "&month=" + arr_date[0] + "&year=" + arr_date[1];
        // window.location = url[0] + "&month=" + arr_date[0] + "&year=" + arr_date[1];
        window.location = url[0] + "?month=" + arr_date[0] + "&year=" + arr_date[1];
        // $event.stopPropagation();

    }

});';

$js2 = '$(".dropdown").on("change", function() {
    var value = $(this).val();
    console.log(value);
    var url = window.location.href.split("akun");
    if(url[0].charAt(url[0].length-1)=="?"||url[0].charAt(url[0].length-1)=="&"){
        url = url[0].substring(0, url[0].length - 1);
    }else{
        url = url[0];
    }
    
    if(url.includes("year")){
        window.location = url + "&akun=" + value;
    }else{
        window.location = url + "?month=" + "'.$month_short.'" + "&year=" + '.$year.'+ "&akun=" + value;
    }
});';

$this->registerJS($js);
$this->registerJS($js2);


?>
<div class="site-rekapt">
    <div class='row'>
        <div class='col-md-12'>
            <div style='width:300px;' class='pull-right'>
                <?php
                    echo DatePicker::widget([
                        'name' => 'check_issue_date',
                        'value' => $month_short.' '.$year, 
                        // 'type' => DatePicker::TYPE_INPUT,
                        'options' => ['placeholder' => 'Pilih bulan & tahun rekapitulasi ...', 'class'=>'date'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'startView'=>'year',
                            'minViewMode'=>'months',
                            'format' => 'M yyyy'
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
                    <!-- <h3 class="panel-title">Rekapitulasi Bulanan <?= '('.$month_long.' '.$year.')';?></h3> -->
                    <!-- <div class="right">
                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                        <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                    </div> -->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="panel-title">Rekapitulasi Bulanan <?= '('.$month_long.' '.$year.')';?></h3>
                        </div>
                        <div class="col-sm-6">
                        <?= Html::dropDownList('s_id', $akun,
                            [
                                524111=>"Surat Tugas Akun Belanja Perjalanan Dinas Biasa (524111)", 
                                524113=>"Surat Tugas Akun Belanja Perjalanan Dinas Dalam Kota (524113)",
                                'all'=>"Surat Tugas Semua Akun (52411 & 524113)"
                            ],
                            // ['prompt'=>'Pilih jenis surat tugas ...', 'class'=>'form-control pull-right dropdown'],
                            ['class'=>'form-control pull-right dropdown']
                        );
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
                                [
                                    'attribute' => 'NAMA',
                                    'format' => 'html',
                                    'value' => function ($data) {
                                        return Html::a($data["NAMA"], ['site/rincian', 'Rekap[nama_pegawai]' => $data["NAMA"]]);
                                    }
                                ],
                                // 'NAMA',
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
                        <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 1 month</span></div>
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
                    <h3 class="panel-title">Grafik Bulanan</h3>
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
		text: <?php echo "'Bulan ".$month_long." Tahun ".$year."'"?>
	},
	xAxis: {
		categories: [
		    <?php //echo "'" . implode("','", $nama) . "'"; ?>
            <?php echo '"' . implode('","', $nama) . '"'; ?>
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
