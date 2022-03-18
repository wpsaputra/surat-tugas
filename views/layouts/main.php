<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);
$this->registerJsFile(
    '@web/vendor/jquery-slimscroll/jquery.slimscroll.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/klorofil-common.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$js = '
$("a").each(function(index, value) { 
    if ($(this).prop("href") === window.location.href) {
		$(this).addClass("active");
		// $(this).addClass("active");

		$(this).parent().parent().parent().parent().children("a").addClass("active").removeClass("collapsed").attr("aria-expanded","true");
		
		$(this).parent().parent().parent().parent().children("div").addClass("collapse in").removeClass("collapse").attr("aria-expanded","true");
		// $(this).parent().parent().parent().parent().children("a").addClass("active");
    }else{
		$(this).removeClass("active");
	}
});
';

$this->registerJS($js);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo Url::to('@web/img/apple-icon.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo Url::to('@web/img/favicon.png');?>">

	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- WRAPPER -->
<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="<?=Yii::$app->urlManager->createUrl('site/index')?>"><img src="<?php echo Url::to('@web/img/logo-dark.png');?>" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<!-- <form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form> -->
				<div class="navbar-btn navbar-btn-right">
					<?php
					if(Yii::$app->user->isGuest){
						echo '<a class="btn btn-danger update-pro" href="'.Yii::$app->urlManager->createUrl('site/login').'" title="login"><i class="fa fa-rocket"></i> <span>LOGIN</span></a>';

					}else{
						echo Html::a('<i class="fa fa-rocket"></i> <span>LOGOUT ('.Yii::$app->user->identity->username.')</span>', ['site/logout'], ['data' => ['method' => 'post'], 'class'=>'btn btn-danger update-pro']);
						// echo '<a class="btn btn-danger update-pro" href="'.Yii::$app->urlManager->createUrl('site/logout').'" title="logout"><i class="fa fa-rocket"></i> <span>LOGOUT ('.Yii::$app->user->identity->username.')</span></a>';
					}
					?>
					
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?=Yii::$app->urlManager->createUrl('site/index')?>" class="active"><i class="lnr lnr-home"></i> <span>Home</span></a></li>
						<!-- <li><a href="<?=Yii::$app->urlManager->createUrl('site/rekapitulasi')?>" class=""><i class="lnr lnr-chart-bars"></i> <span>Rekapitulasi</span></a></li> -->
						<li>
							<a href="#subRekap" data-toggle="collapse" class="collapsed"><i class="lnr lnr-chart-bars"></i> <span>Rekapitulasi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subRekap" class="collapse ">
								<ul class="nav">
									<li><a href="<?=Yii::$app->urlManager->createUrl('site/rekapt')?>" class="">Rekap Tahunan</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('site/rekapb')?>" class="">Rekap Bulanan</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('site/rincian')?>" class="">Rincian Perjalanan</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#subPegawai" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Pegawai</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPegawai" class="collapse ">
								<ul class="nav">
									<li><a href="<?=Yii::$app->urlManager->createUrl('pegawai/create')?>" class="">Tambah Pegawai</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('pegawai/index')?>" class="">Daftar Pegawai</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('kepala/create')?>" class="">Edit Kepala Kantor</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('bendahara/create')?>" class="">Edit Bendahara</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('ppk/create')?>" class="">Edit PPK</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('ppk-dukman/create')?>" class="">Edit PPK Dukman</a></li>
								</ul>
							</div>
						</li>
						<!-- <li><a href="notifications.html" class=""><i class="lnr lnr-cart"></i> <span>Anggaran</span></a></li> -->
						<li>
							<a href="#subAnggaran" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cart"></i> <span>Anggaran</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subAnggaran" class="collapse ">
								<ul class="nav">
									<li><a href="<?=Yii::$app->urlManager->createUrl('program/index')?>" class="">Kelola Program</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('kegiatan/index')?>" class="">Kelola Kegiatan</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('output/index')?>" class="">Kelola Output</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('komponen/index')?>" class="">Kelola Komponen</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>SPD & Kwitansi (Old)</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="<?=Yii::$app->urlManager->createUrl('stspd/index')?>" class="">Kelola Surat Tugas & SPD</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('kwitansi/index')?>" class="">Kelola Kwitansi</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>SPD & Kwitansi (New)</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse ">
								<ul class="nav">
									<li><a href="<?=Yii::$app->urlManager->createUrl('stspd-new/index')?>" class="">Kelola Surat Tugas & SPD</a></li>
									<li><a href="<?=Yii::$app->urlManager->createUrl('kwitansinew/index')?>" class="">Kelola Kwitansi</a></li>
								</ul>
							</div>
						</li>
						<li><a href="<?=Yii::$app->urlManager->createUrl('site/changepassword')?>" class=""><i class="lnr lnr-cog"></i> <span>Ubah Password</span></a></li>
						<li><a href="<?=Yii::$app->urlManager->createUrl('site/faq')?>" class=""><i class="lnr lnr-book"></i> <span>FAQ</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
				<?= Alert::widget() ?>
				<?= $content ?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
