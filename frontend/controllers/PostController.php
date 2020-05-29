<?php

namespace frontend\controllers;

use Yii;
use common\models\City;
use common\models\QuizAnswer;
use common\models\CategoryQuestion;
use common\models\ImagePost;
use common\models\HelperModel;
use common\models\ImagePostSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\Expression;

/**
 * PostController implements the CRUD actions for ImagePost model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['category', 'city-list', 'view'],
                        'allow' => true,
                        'roles' => ['?','@'],
                    ],                    

                    [
                        'actions' => ['create','category', 'category-question', 'update', 'delete'],
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
     * Lists all ImagePost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagePostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategory($category_id)
    {
        $listDataProvider = new \yii\data\ActiveDataProvider([
            'query' => ImagePost::find()->where(['category_id' => (int)$category_id,'status' => 10])->orderBy('post_id DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('search_result', [
            'listDataProvider' => $listDataProvider,
        ]);
    }    

    public function actionCategoryQuestion($post_id,$category_id)
    {
        if (isset($post_id) && isset($category_id)) {

            $questions = CategoryQuestion::find()
                ->where(['category_id' => (int)$category_id])
                ->orderBy(new Expression('rand()'))
                ->limit(3)->all();

            $answerModel = new QuizAnswer;

            if ($answerModel->load(Yii::$app->request->post())) { 

                $modelsQuizAnswer = HelperModel::createMultiple(QuizAnswer::classname());
                HelperModel::loadMultiple($modelsQuizAnswer, Yii::$app->request->post());
                $valid = HelperModel::validateMultiple($modelsQuizAnswer);

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {

                        foreach ($modelsQuizAnswer as $answer) {
                            $answer->category_id = $category_id;
                            $answer->post_id = $post_id;
                            if (! ($flag = $answer->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $post_id]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            }

            return $this->render('question', [
                'answerModel' => $answerModel,
                'questions' => $questions,
            ]);
        }

        throw new NotFoundHttpException('The requested page does not exist.');

    }


    /**
     * Displays a single ImagePost model.
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
     * Creates a new ImagePost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImagePost();

        $model->user_id = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {
            $model->mainImageUrl = UploadedFile::getInstance($model, 'mainImageUrl');
            $imageName = $model->upload();
            $model->main_image_url = $imageName;
            $model->thumbnail_url = $imageName;

            if ($model->validate() && $model->save(false)) { 
                //return $this->redirect(['view', 'id' => $model->post_id]);
                return $this->redirect(['category-question', 'post_id' => $model->post_id,'category_id'=>$model->category_id]);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ImagePost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->post_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ImagePost model.
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

    public function actionCityList() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $cities = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $country_id = $parents[0];

                $cities = City::find()
                ->where(['country_id' => (int)$country_id])
                ->select(['city_id AS id','city_name AS name'])
                ->asArray()->all(); 
                // the getSubCatList function will query the database based on the

                return ['output'=> $cities, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
     

    /**
     * Finds the ImagePost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImagePost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImagePost::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
