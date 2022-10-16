<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Event;
use app\models\User;
use app\models\Venue;
use app\models\Content;

class UtilityController extends Controller
{
  public $layout = 'admin';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index','content', 'approveEvent', 'editEvent', 'deleteEvent','approveVenue','editVenue','deleteVenue'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                          return User::isUserAdmin(\Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
     * Displays Utility index
     *
     * @return string
     */
    public function actionIndex()
    {
      return $this->render(
        'index',
        [
          'events' => Event::getPendingEvents(),
          'venues' => Venue::getPendingVenues()
        ]
      );
    }


    public function actionContent()
    {

      if ($this->request->isPost && isset($this->request->post()['Content'])) {
        $id = $this->request->post()['Content']['id'];
        $model = Content::find()->where(['id' => $id])->one();
        if ($model->load($this->request->post()) && $model->save()) {
          \Yii::$app->session->setFlash('success', "Updated {$model->name} content successfully." );
          $contents = Content::find()->all();
          return $this->render('content', ['contents' => $contents]);
        }
      }

      $contents = Content::find()->all();
      return $this->render(
        'content',  [
          'contents' => $contents
        ]
      );
    }

    public function actionApproveEvent($id) {
      $event = Event::findById($id);
      $event->status = "approved";
      $event->save();
      return $this->redirect(['index']);
    }

    public function actionDeleteEvent($id) {
      $event = Event::findById($id)->delete();
      return $this->redirect(['index']);
    }

    public function actionEditEvent($id) {
      $model = Event::findById($id);

      if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['/event/view', 'id' => $model->id]);
      }

      return $this->render('/event/update', [
        'model' => $model,
        'venues' => \app\models\Venue::find()->all(),
        'isAdmin' => true
      ]);
    }

    public function actionApproveVenue($id) {
      $venue = Venue::findById($id);
      $venue->status = "approved";
      if($venue->save()) {
        Yii::$app->session->setFlash('success', "Approved {$venue->name}." );
      } else {
        Yii::$app->session->setFlash('danger', "Could not delete this. Why?" );
      };
      return $this->redirect(['index']);
    }

    public function actionDeleteVenue($id) {
      $venue = Venue::findById($id);
      if($venue && $venue->delete()) {
        Yii::$app->session->setFlash('success', "Deleted {$venue->name}." );
      } else {
        Yii::$app->session->setFlash('danger', "Could not delete this. Why?" );
      };
      return $this->redirect(['index']);
    }

    /**
     * Requires all users to be logged in before doing anything here.
     */
    public function beforeAction($action) {
      if(\Yii::$app->user->isGuest) {
        \Yii::$app->user->loginRequired();
      }
      if (!parent::beforeAction($action)) {
        return false;
      }

      return true;
    }

}
