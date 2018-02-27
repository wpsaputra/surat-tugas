<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use PhpOffice\PhpWord\TemplateProcessor;
use yii\data\SqlDataProvider;
use yii\data\Sort;
use yii\web\HttpException;
use app\models\User;
use app\models\PasswordForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'rekapt', 'rekapb'],
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFaq()
    {
        return $this->render('faq');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
    //         Yii::$app->session->setFlash('contactFormSubmitted');

    //         return $this->refresh();
    //     }
    //     return $this->render('contact', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Displays about page.
     *
     * @return string
     */
    // public function actionAbout()
    // {
    //     $templateProcessor = new TemplateProcessor('template/template.docx');
    //     $templateProcessor->setValue('Name', 'John Doe');
    //     $templateProcessor->setValue(array('City', 'Street'), array('Detroit', '12th Street'));
    //     $templateProcessor->saveAs("template/tes.docx");
    //     return $this->render('about');
    // }

    public function actionRekapt()
    {
        $year = Yii::$app->request->get('year');
        if(!is_numeric($year)&&!is_null($year)){
            throw new HttpException(403, "Invalid parameters value.");
        }

        if(is_null($year)){
            $year = Date('Y');
        }
        
		$sql = "SELECT s.nip AS NIP, p.nama AS NAMA, COUNT(s.nip) AS JUMLAH, SUM(DATEDIFF(s.tanggal_kembali, s.tanggal_pergi)+1) AS HARI, p.jabatan AS JABATAN
        FROM su_st_spd s INNER JOIN su_pegawai p ON s.nip=p.nip WHERE s.id_instansi=".Yii::$app->user->identity->id_instansi." AND YEAR(tanggal_terbit)=".$year." GROUP BY s.nip";

        $rawData = Yii::$app->db->createCommand($sql)->getRawSql(); //or use ->queryAll(); in CArrayDataProvider
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count


        $model = new SqlDataProvider(array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
            'sql' => $rawData,
            'totalCount' => $count,

            'sort' => array(
                'attributes' => array(
                    'NIP', 'NAMA', 'JUMLAH', 'HARI', 'JABATAN'
                ),
                'defaultOrder' => array(
                    'JUMLAH' => SORT_DESC, //default sort value
                ),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));


        $arr = $model->getModels();
        $nama = array();
        $jumlah = array();
        foreach ($arr as $key=>$value){
            $nama[] = $value["NAMA"];
            $jumlah[] = $value["JUMLAH"];
        }


        return $this->render('rekapt', array(
            'model' => $model,
            'nama' => $nama,
            'jumlah' => $jumlah,
            'year' => $year
        ));

    }

    public function actionRekapb()
    {
        $year = Yii::$app->request->get('year');
        if(!is_numeric($year)&&!is_null($year)){
            throw new HttpException(403, "Invalid parameters value.");
        }

        if(is_null($year)){
            $year = Date('Y');
        }

        $month = Yii::$app->request->get('month');
        if(is_null($month)){
            $month = Date('m');
            $month_long = Date('F');
            $month_short = Date('M');
        }else{
            if (!in_array($month, ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'])) {
                throw new HttpException(403, "Invalid parameters value.");
            }
            $month = Date('m', strtotime("2011-".$month."-15"));
            $month_long = Date('F', strtotime("2011-".$month."-15"));
            $month_short = Date('M', strtotime("2011-".$month."-15"));
        }

		$sql = "SELECT s.nip AS NIP, p.nama AS NAMA, COUNT(s.nip) AS JUMLAH, SUM(DATEDIFF(s.tanggal_kembali, s.tanggal_pergi)+1) AS HARI, p.jabatan AS JABATAN
				FROM su_st_spd s INNER JOIN su_pegawai p ON s.nip=p.nip WHERE s.id_instansi=".Yii::$app->user->identity->id_instansi." AND YEAR(tanggal_terbit)=".$year." AND MONTH(tanggal_terbit)=".$month." GROUP BY s.nip";

        $rawData = Yii::$app->db->createCommand($sql)->getRawSql(); //or use ->queryAll(); in CArrayDataProvider
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count


        $model = new SqlDataProvider(array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
            'sql' => $rawData,
            'totalCount' => $count,

            'sort' => array(
                'attributes' => array(
                    'NIP', 'NAMA', 'JUMLAH', 'HARI', 'JABATAN'
                ),
                'defaultOrder' => array(
                    'JUMLAH' => SORT_DESC, //default sort value
                ),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));


        $arr = $model->getModels();
        $nama = array();
        $jumlah = array();
        foreach ($arr as $key=>$value){
            $nama[] = $value["NAMA"];
            $jumlah[] = $value["JUMLAH"];
        }


        return $this->render('rekapb', array(
            'model' => $model,
            'nama' => $nama,
            'jumlah' => $jumlah,
            'year' => $year,
            'month_long' => $month_long,
            'month_short' => $month_short
        ));

    }

    public function actionChangepassword(){
        $model = new PasswordForm;
        $modeluser = User::find()->where([
            'id'=>Yii::$app->user->id
        ])->one();
      
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                try{
                    $modeluser->password = $_POST['PasswordForm']['newpass'];
                    if($modeluser->save()){
                        Yii::$app->getSession()->setFlash(
                            'success','Password changed'
                        );
                        return $this->redirect(['index']);
                    }else{
                        Yii::$app->getSession()->setFlash(
                            'error','Password not changed'
                        );
                        return $this->redirect(['index']);
                    }
                }catch(Exception $e){
                    Yii::$app->getSession()->setFlash(
                        'error',"{$e->getMessage()}"
                    );
                    return $this->render('changepassword',[
                        'model'=>$model
                    ]);
                }
            }else{
                return $this->render('changepassword',[
                    'model'=>$model
                ]);
            }
        }else{
            return $this->render('changepassword',[
                'model'=>$model
            ]);
        }
    }



}
