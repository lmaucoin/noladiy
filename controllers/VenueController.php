<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Venue;
use app\models\VenueSearch;
use app\models\Event;
use app\models\User;
use app\models\Content;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VenueController implements the CRUD actions for Venue model.
 */
class VenueController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
              'access' => [
              'class' => AccessControl::class,
              'only' => ['approve','delete','update'],
              'rules' => [
                [
                  'actions' => ['approve','delete','update'],
                  'allow' => true,
                  'roles' => ['@'],
                  'matchCallback' => function ($rule, $action) {
                    return User::isUserAdmin(\Yii::$app->user->identity->username);
                  }
        ],
              ]
            ]
            ],
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Venue models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $eventVenueContent = Content::find()
          ->where(['name' => 'venue-index'])->one();
        $regions = Venue::getRegions();

        return $this->render('index', [
          'regions' => $regions,
          'content' => $eventVenueContent->content
        ]);
    }

    /**
     * Displays a single Venue model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      $events = Event::find()
        ->where(['venue_id' => $id])
        ->andWhere(['>', 'date', new Expression('NOW()')])
        ->andWhere(['=', 'status', 'approved'])
        ->orderBy('date', 'ASC')
        ->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'events' => $events
        ]);
    }

    /**
     * Creates a new Venue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Venue();
        $isGuest = Yii::$app->user->isGuest;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
              $model->status = $isGuest ? "pending" : "approved";
              if($model->save()) {
                $flashMessage = $isGuest ?
                  "The venue has been submitted successfully." :
                  "The venue has been submitted and will appear when approved.";
                \Yii::$app->session->setFlash(
                  'success',
                  $flashMessage
                );
                return $this->redirect('index');
              } else {
                \Yii::$app->session->setFlash(
                  'danger',
                  'There was an error saving the venue:<br>' .
                    join("<br>", $model->errors)
                );

              }
            }
        } else {
            $model->loadDefaultValues();
        }
        $content = Content::find()->where(['name' => 'venue-create'])->one();
        return $this->render('create', [
            'model' => $model,
            'content' => $content->content
        ]);
    }

    /**
     * Updates an existing Venue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Venue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $isAdmin = User::isUserAdmin(Yii::$app->user->identity->username);
        if(!$isAdmin) {
          Yii::$app->session->setFlash('danger', 'Only admins can delete.');
          return $this->redirect(['index']);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Venue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Venue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venue::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
