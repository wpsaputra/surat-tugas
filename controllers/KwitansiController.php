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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
                
                return Html::renderSelectOptions([], $arr_total_pegawai, $tagOptions);
                break;
        }
        
    }
}