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

/**
 * StspdController implements the CRUD actions for StSpd model.
 */
class StspdController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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
            $dataProvider->query->andFilterWhere(['id_instansi' => Yii::$app->user->identity->id_instansi]);
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
