<?php

namespace app\controllers;

use Yii;
use app\models\Kwitansi;
use app\models\KwitansiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Pegawai;
use app\models\StSpd;
use app\models\StSpdAnggota;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * KwitansiController implements the CRUD actions for Kwitansi model.
 */
class KwitansiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'get', 'getmulti'],
                'rules' => [
                    [
                        // 'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],


            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Kwitansi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KwitansiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Only show pegawai based on curent user instansi
        if(Yii::$app->user->identity->role!=99){
            $dataProvider->query->andFilterWhere(['su_st_spd.id_instansi' => Yii::$app->user->identity->id_instansi]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kwitansi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Kwitansi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kwitansi();

        if ($model->load(Yii::$app->request->post())) {
            $arr_st_spd = StSpd::find()->where(['id'=>$model->id_st])->asArray()->one();
            if($arr_st_spd['id_akun']==524111){
                $model->setScenario(Kwitansi::SCENARIO_LUAR_KOTA);
            }else{
                $model->detachBehavior("auto_fill_biaya_inap_riil_total");
                $model->detachBehavior("auto_fill_representasi_riil_total");
                $model->detachBehavior("auto_fill_jumlah_riil");
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->createDocx();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kwitansi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->createDocx();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Kwitansi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kwitansi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kwitansi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kwitansi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGet(){
        $request = Yii::$app->request;
        $obj = $request->post('obj');
        $value = $request->post('value');
        $value2 = $request->post('value');
        $tagOptions = ['prompt' => "=== Select ==="];

        switch ($obj) {
            case 'kwitansi-id_st':
                $ketua = StSpd::find()->where(['id' => $value])->all();
                $anggota = StSpdAnggota::find()->where(['id_st_spd' => $value])->all();
                $arr_total_pegawai = [];

                // get array nip => nama from ketua and anggota
                foreach ($ketua as $key => $value) {
                    $arr_total_pegawai[$value["nip"]] = Pegawai::find()->where(['nip'=>$value["nip"]])->asArray()->one()['nama'];
                }

                foreach ($anggota as $key => $value) {
                    $arr_total_pegawai[$value["nip_anggota"]] = Pegawai::find()->where(['nip'=>$value["nip_anggota"]])->asArray()->one()['nama'];
                }

                if(StSpd::find()->where(['id' => $value2])->asArray()->one()["id_akun"]==524111||StSpd::find()->where(['id' => $value2])->asArray()->one()["xid_akun"]==2){
                    $isFieldEnabled = true;
                }else{
                    $isFieldEnabled = false;
                }

                $arr_response = ['pegawai'=>Html::renderSelectOptions([], $arr_total_pegawai, $tagOptions), 'isFieldEnabled'=>$isFieldEnabled];
                
                // return Html::renderSelectOptions([], $arr_total_pegawai, $tagOptions);
                return json_encode($arr_response);
                break;
        }
        
    }

    public function actionGetmulti(){
        $request = Yii::$app->request;
        $id_st = $request->post('id_st');
        $nip = $request->post('tanggal_kembali');

        $surat_tugas = StSpd::find()->where(['id'=>$id_st])->asArray()->one();
        $pegawai = Pegawai::find()->where(['nip'=>$surat_tugas['nip']])->asArray()->one();
        $bendahara = Pegawai::find()->where(['nip'=>$surat_tugas['nip_bendahara']])->asArray()->one();
        $ppk = Pegawai::find()->where(['nip'=>$surat_tugas['nip_ppk']])->asArray()->one();

        $date1 = new \DateTime($surat_tugas['tanggal_pergi']);
		$date2 = new \DateTime($surat_tugas['tanggal_kembali']);
        $diff = $date2->diff($date1)->format("%a")+1;

        // $pegawai = Pegawai::find()->where(['nip' => $value])->asArray()->one();
        // return json_encode($pegawai);

        return json_encode(['surat_tugas'=>$surat_tugas, 'pegawai'=>$pegawai, 'bendahara'=>$bendahara, 'ppk'=>$ppk, 'hari'=>$diff]);
        
    }
}
