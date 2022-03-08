<?php

namespace app\controllers;

use Yii;
use app\models\StSpd;
use app\models\StSpdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StSpdAnggota;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Kegiatan;
use app\models\Output;
use app\models\Komponen;
use app\models\TemplateNew;
use app\models\Pegawai;
use yii\filters\AccessControl;
use app\models\TProgram;
use app\models\Instansi;
use app\models\TGiat;
use app\models\TOutput;

/**
 * StspdController implements the CRUD actions for StSpd model.
 */
class StspdnewController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'get', 'getpegawai', 'gethari'],
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
     * Lists all StSpd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StSpdSearch();
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
     * Displays a single StSpd model.
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
     * Creates a new StSpd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $model = new StSpd();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);

        $model = new StSpd();
        $modelsAnggota = [new StSpdAnggota];
        $model->setScenario(StSpd::SCENARIO_INSERT);

        // Only admin can change pegawai instansi otherwise auto_fill_instansi_with_user
        if(Yii::$app->user->identity->role==99){
            $model->setScenario(StSpd::SCENARIO_ADMIN);
            $model->detachBehavior("auto_fill_instansi_with_user");
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            $model->createDocx();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsAnggota' => (empty($modelsAnggota)) ? [new StSpdAnggota] : $modelsAnggota
            ]);
        }

    }

    /**
     * Updates an existing StSpd model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);

        $model = $this->findModel($id);;
        $modelsAnggota = $model->stSpdAnggotas;

        // Only admin can change pegawai instansi otherwise auto_fill_instansi_with_user
        if(Yii::$app->user->identity->role==99){
            $model->setScenario(StSpd::SCENARIO_ADMIN);
            $model->detachBehavior("auto_fill_instansi_with_user");
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            $model->createDocx();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsAnggota' => (empty($modelsAnggota)) ? [new StSpdAnggota] : $modelsAnggota
            ]);
        }
    }

    /**
     * Deletes an existing StSpd model.
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
     * Finds the StSpd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StSpd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StSpd::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGet(){
        $request = Yii::$app->request;
        $obj = $request->post('obj');
        $value = $request->post('value');
        $tagOptions = ['prompt' => "=== Select ==="];

        switch ($obj) {
            case 'stspd-kode_program':
                $data = Kegiatan::find()->where(['id_prog' => $value])->all();
                return Html::renderSelectOptions([], ArrayHelper::map($data, 'kode', 'uraian'), $tagOptions);
                break;
            case 'stspd-kode_kegiatan':
                $data = Output::find()->where(['id_kegiatan' => $value])->all();
                return Html::renderSelectOptions([], ArrayHelper::map($data, 'kode', 'uraian'), $tagOptions);
                break;
            case 'stspd-kode_output':
                $data = Komponen::find()->where(['id_output' => $value])->all();
                return Html::renderSelectOptions([], ArrayHelper::map($data, 'id', 'uraian'), $tagOptions);
                break;
        }
        
    }

    public function actionGetrkakl(){
        $request = Yii::$app->request;
        $obj = $request->post('obj');
        $value = $request->post('value');
        $tagOptions = ['prompt' => "=== Select ==="];

        $thang = Date('Y');
        $kdsatker = Instansi::find()->where(['id'=> Yii::$app->user->identity->id_instansi])->asArray()->one()['unit_kerja'];

        switch ($obj) {
            case 'stspd-kode_program':
                // $data = Kegiatan::find()->where(['id_prog' => $value])->all();
                // return Html::renderSelectOptions([], ArrayHelper::map($data, 'kode', 'uraian'), $tagOptions);

                $kdprogram = TProgram::find()->where(['id' => $value])->asArray()->one()['kdprogram'];
                $keg = Yii::$app->db->createCommand("SELECT *, CONCAT(thang, '.', kddept, '.', kdunit, '.', kdprogram, '.', kdgiat) AS keg FROM `su_d_item` WHERE thang='".$thang."' AND kdsatker='".$kdsatker."' AND kdprogram='".$kdprogram."' GROUP BY keg")->queryAll();
                $imp = "'" . implode( "','", (ArrayHelper::getColumn($keg, 'keg')) ) . "'";
                $arr_keg = Yii::$app->db->createCommand("SELECT a.* FROM (SELECT *, CONCAT(thang, '.', kddept, '.', kdunit, '.', kdprogram, '.', kdgiat) AS keg,
                    CONCAT('[', kdgiat, '] ', nmgiat) AS nmgiat2 FROM `su_t_giat`) a WHERE a.keg IN (".$imp.")")->queryAll();
                return Html::renderSelectOptions([], ArrayHelper::map($arr_keg, 'id', 'nmgiat2'), $tagOptions);
                break;
            case 'stspd-kode_kegiatan':
                // $data = Output::find()->where(['id_kegiatan' => $value])->all();
                // return Html::renderSelectOptions([], ArrayHelper::map($data, 'kode', 'uraian'), $tagOptions);
                
                $kdgiat = TGiat::find()->where(['id' => $value])->asArray()->one()['kdgiat'];
                $output = Yii::$app->db->createCommand("SELECT *, CONCAT(thang, '.', kdgiat, '.', kdoutput) AS output FROM `su_d_item` WHERE thang='".$thang."' AND kdsatker='".$kdsatker."' AND kdgiat='".$kdgiat."' GROUP BY output")->queryAll();
                $imp = "'" . implode( "','", (ArrayHelper::getColumn($output, 'output')) ) . "'";
                $arr_output = Yii::$app->db->createCommand("SELECT a.* FROM (SELECT *, CONCAT(thang, '.', kdgiat, '.', kdoutput) AS output,
                    CONCAT('[', kdoutput, '] ', nmoutput) AS nmoutput2 FROM `su_t_output`) a WHERE a.output IN (".$imp.")")->queryAll();
                return Html::renderSelectOptions([], ArrayHelper::map($arr_output, 'id', 'nmoutput2'), $tagOptions);
                break;
            case 'stspd-kode_output':
                // $data = Komponen::find()->where(['id_output' => $value])->all();
                // return Html::renderSelectOptions([], ArrayHelper::map($data, 'id', 'uraian'), $tagOptions);
                
                $kdoutput = TOutput::find()->where(['id' => $value])->asArray()->one()['kdoutput'];
                $komponen = Yii::$app->db->createCommand("SELECT *, CONCAT(thang, '.', kddept, '.', kdunit, '.', kdprogram, '.', kdgiat, '.', kdoutput, '.', kdkmpnen) AS komponen FROM `su_d_item` WHERE thang='".$thang."' AND kdsatker='".$kdsatker."' AND kdoutput='".$kdoutput."' GROUP BY komponen")->queryAll();
                $imp = "'" . implode( "','", (ArrayHelper::getColumn($komponen, 'komponen')) ) . "'";
                $arr_komponen = Yii::$app->db->createCommand("SELECT a.* FROM (SELECT *, CONCAT(thang, '.', kddept, '.', kdunit, '.', kdprogram, '.', kdgiat, '.', kdoutput, '.', kdkmpnen) AS komponen, 
                    CONCAT('[', kdkmpnen, '] ', nmkmpnen) AS nmkmpnen2 FROM `su_t_komponen`) a WHERE a.komponen IN (".$imp.")")->queryAll();
                return Html::renderSelectOptions([], ArrayHelper::map($arr_komponen, 'id', 'nmkmpnen2'), $tagOptions);
                break;
        }
        
    }

    public function actionGetpegawai(){
        $request = Yii::$app->request;
        $value = $request->post('value');

        $pegawai = Pegawai::find()->where(['nip' => $value])->asArray()->one();
        return json_encode($pegawai);
    }

    public function actionGethari(){
        $request = Yii::$app->request;
        $tanggal_pergi = $request->post('tanggal_pergi');
        $tanggal_kembali = $request->post('tanggal_kembali');

        $date1 = new \DateTime($tanggal_pergi);
		$date2 = new \DateTime($tanggal_kembali);
        $diff = $date2->diff($date1)->format("%a")+1;

        // $pegawai = Pegawai::find()->where(['nip' => $value])->asArray()->one();
        // return json_encode($pegawai);

        return json_encode($diff);
        
    }

}
