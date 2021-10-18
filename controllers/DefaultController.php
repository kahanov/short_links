<?php

namespace kahanov\shortlinks\controllers;

use kahanov\shortlinks\core\forms\CreateForm;
use kahanov\shortlinks\core\models\ShortLinks;
use kahanov\shortlinks\core\services\ShortLinksService;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class DefaultController extends Controller
{
    private $shortLinksService;

    /**
     * DefaultController constructor.
     * @param $id
     * @param $module
     * @param ShortLinksService $shortLinksService
     * @param array $config
     */
    public function __construct($id, $module, ShortLinksService $shortLinksService, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->shortLinksService = $shortLinksService;
    }

    /**
     * @return array|string
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $form = new CreateForm();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                try {
                    $shortLink = $this->shortLinksService->createShortLink($form);
                    $status = 'error';
                    $longUrl = $form->url;
                    $shortUrl = '';
                    if ($shortLink) {
                        $status = 'succ';
                        $shortUrl = Yii::$app->urlManager->createAbsoluteUrl(['short-links/default/view', 'slug' => $shortLink->short_code]);
                    }

                    return ['status' => $status, 'longUrl' => $longUrl, 'shortUrl' => $shortUrl];
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            } else {
                return ActiveForm::validate($form);
            }
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }

    /**
     * @param string $slug
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionView(string $slug)
    {
        $shortLink = $this->findModel($slug);

        return $this->redirect($shortLink->url);
    }

    /**
     * @param string $slug
     * @return ShortLinks
     * @throws NotFoundHttpException
     */
    protected function findModel(string $slug): ShortLinks
    {
        if (($model = ShortLinks::find()->where(['short_code' => $slug])->limit(1)->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'Запрашиваемая страница не существует'));
    }
}
