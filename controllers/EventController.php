<?php

namespace app\controllers;

use Yii;
use app\models\Event;
use app\models\EventSearch;
use app\models\Venue;
use app\models\Content;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
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
              ],
              ],
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
     * Lists all Event models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $isAdmin = !Yii::$app->user->isGuest && User::isUserAdmin(\Yii::$app->user->identity->username);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $events = Event::getFutureEvents();
        $eventIndexContent = Content::find()
          ->where(['name' => 'event-index'])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'events' => $events,
            'eventIndexContent' => $eventIndexContent->content,
            'isAdmin' => $isAdmin
        ]);
    }

    /**
     * Displays a single Event model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Event();
        $loggedIn = !\Yii::$app->user->isGuest;
        $isAdmin = $loggedIn &&
          User::isUserAdmin(Yii::$app->user->identity->username);
        $venues = Venue::find()->all();

        $eventCreateContent = Content::find()
          ->where(['name' => 'event-create'])
          ->one();

        if ($this->request->isPost) {
          if ($model->load($this->request->post())) {
            if($model->message) {
              return $this->render(['index']);
            }
            $formattedDate = (new \DateTime($model->date))->format("Y-m-d");
            $formattedTime = $model->start_time . ":00";

            $model->start_time = $formattedTime;
            $model->date = $formattedDate;
            $model->status = $loggedIn ? "approved" : "pending";
            if( $model->save() ) {
              $flashMessage = $loggedIn ?
                "Your event has been submitted successfully." :
                "Your event has been submitted and will appear when approved.";
              \Yii::$app->session->setFlash('success', $flashMessage);
              return $this->redirect(['view', 'id' => $model->id]);
            } else {
              \Yii::$app->session->setFlash(
                'danger',
                'There was an error saving the event:<br>' .
                join("<br>", $model->errors)
              );
            }
          }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'venues' => $venues,
            'eventCreateContent' => $eventCreateContent->content,
            'isAdmin' => $isAdmin
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $isAdmin = User::isUserAdmin(\Yii::$app->user->identity->username);
        $model = $this->findModel($id);
        $venues = Venue::find()->all();

        if(\Yii::$app->user->isGuest) {
          \Yii::$app->user->loginRequired();
        }


        return $this->render('update', [
          'model' => $model,
          'venues' => $venues,
          'isAdmin' => $isAdmin
        ]);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
