<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 17.05.2015
 */
namespace skeeks\cms\controllers;

use skeeks\cms\helpers\RequestResponse;
use skeeks\cms\helpers\UrlHelper;
use skeeks\cms\models\CmsTreeTypeProperty;
use skeeks\cms\modules\admin\controllers\AdminModelEditorController;
use skeeks\cms\relatedProperties\models\RelatedPropertyModel;
use yii\helpers\ArrayHelper;

/**
 * Class AdminCmsTreeTypePropertyController
 * @package skeeks\cms\controllers
 */
class AdminCmsTreeTypePropertyController extends AdminModelEditorController
{
    public $notSubmitParam = 'sx-not-submit';

    public function init()
    {
        $this->name                   = "Управление свойствами раздела";
        $this->modelShowAttribute      = "name";
        $this->modelClassName          = CmsTreeTypeProperty::className();

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(),
            [
                'create' =>
                [
                    'callback'         => [$this, 'create'],
                ],

                'update' =>
                [
                    'callback'         => [$this, 'update'],
                ],
            ]
        );
    }

    public function create()
    {
        $rr = new RequestResponse();

        $modelClass = $this->modelClassName;
        $model = new $modelClass();
        $model->loadDefaultValues();

        if ($post = \Yii::$app->request->post())
        {
            $model->load($post);
        }

        $handler = $model->handler;
        if ($handler)
        {
            if ($post = \Yii::$app->request->post())
            {
                $handler->load($post);
            }
        }

        if ($rr->isRequestPjaxPost())
        {
            if (!\Yii::$app->request->post($this->notSubmitParam))
            {
                $model->component_settings = $handler->toArray();
                $handler->load(\Yii::$app->request->post());

                if ($model->load(\Yii::$app->request->post())
                    && $model->validate() && $handler->validate())
                {
                    $model->save();

                    \Yii::$app->getSession()->setFlash('success', \Yii::t('skeeks/cms','Saved'));

                    return $this->redirect(
                        UrlHelper::constructCurrent()->setCurrentRef()->enableAdmin()->setRoute($this->modelDefaultAction)->normalizeCurrentRoute()
                            ->addData([$this->requestPkParamName => $model->{$this->modelPkAttribute}])
                            ->toString()
                    );
                } else
                {
                    \Yii::$app->getSession()->setFlash('error', \Yii::t('skeeks/cms','Could not save'));
                }
            }
        }

        return $this->render('_form', [
            'model'     => $model,
            'handler'   => $handler,
        ]);
    }


    public function update()
    {
        $rr = new RequestResponse();

        $model = $this->model;

        if ($post = \Yii::$app->request->post())
        {
            $model->load($post);
        }

        $handler = $model->handler;
        if ($handler)
        {
            if ($post = \Yii::$app->request->post())
            {
                $handler->load($post);
            }
        }

        if ($rr->isRequestPjaxPost())
        {
            if (!\Yii::$app->request->post($this->notSubmitParam))
            {
                if ($rr->isRequestPjaxPost())
                {
                    $model->component_settings = $handler->toArray();
                    $handler->load(\Yii::$app->request->post());

                    if ($model->load(\Yii::$app->request->post())
                        && $model->validate() && $handler->validate())
                    {
                        $model->save();

                        \Yii::$app->getSession()->setFlash('success', \Yii::t('skeeks/cms','Saved'));

                        if (\Yii::$app->request->post('submit-btn') == 'apply')
                        {

                        } else
                        {
                            return $this->redirect(
                                $this->indexUrl
                            );
                        }

                        $model->refresh();

                    }
                }
            }
        }

        return $this->render('_form', [
            'model'     => $model,
            'handler'   => $handler,
        ]);
    }
}
