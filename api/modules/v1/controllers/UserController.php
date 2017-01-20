<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/24 0024
 * Time: 16:22
 */

namespace api\modules\v1\controllers;

use api\modules\v1\models\Article;
use api\modules\v1\models\ResetPasswordForm;
use api\utils\Pagination;
use common\models\ArticleComment;
use common\models\UserMessage;
use common\models\UploadForm;
use common\models\UserCollection;
use Yii;
use api\models\User;
use common\models\LoginForm;
use yii\base\Model;
use yii\db\Query;
use yii\web\UploadedFile;

class UserController extends BaseController
{
    /**
     *  注册
     */
    public function actionRegister()
    {
        $userInfo = [];
        if (Yii::$app->request->isPost) {
            $user = new User();
            $user->scenario = User::SCENARIO_ADD;
            $post = Yii::$app->request->post();
            if ($user->load($post, '')) {
                $result = $user->save();
                if (!$result) {
                    return [
                        'code' => 1,
                        'message' => $user->getFirstErrorMessage()
                    ];
                } else {
                    $loginForm = new LoginForm();
                    $loginForm->load([
                        'username' => $post['account'],
                        'pwd' => $post['password']
                    ], '');
                    if ($result = $loginForm->login()) {
                        $userInfo = $loginForm->getUser();
                    }
                }
            }
        }

        return $userInfo;
    }

    /**
     * 登录
     */
    public function actionLogin()
    {
        $userInfo = [];
        if (Yii::$app->request->isPost) {
            $loginForm = new LoginForm();
            $post = Yii::$app->request->post();
            if (!isset($post['account']) || !isset($post['pwd'])) {
                return [
                    'code' => 1,
                    'message' => '参数错误'
                ];
            }
            if ($loginForm->load(['username' => $post['account'], 'pwd' => $post['pwd']], '')) {
                if ($result = $loginForm->login()) {
                    $userInfo = $loginForm->getUser();
                    if ($userInfo->avatar != '') {
                        $userInfo->avatar = Yii::getAlias('@staticUrlImage').$userInfo->avatar;
                    }
                } else {
                    return [
                        'code' => 1,
                        'message' => $loginForm->getFirstErrorMessage()
                    ];
                }
            }
        }

        return $userInfo;
    }

    /**
     * 退出
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
    }



    /**
     * 上传文件
     */
    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $uploadForm = new UploadForm();
            $uploadForm->load($post, '');
            //var_dump($uploadForm);die;
            $uploadForm->file = UploadedFile::getInstanceByName('file');
            //var_dump($_FILES);die;

            $path = '/uploads/'.date('Ymd');
            if ($uploadForm->upload($path)) {
                $userId = Yii::$app->user->getId();
                Yii::$app->db->createCommand()
                    ->update('core_user', ['avatar' => $uploadForm->file], ['id' => $userId])
                    ->execute();

                return Yii::getAlias('@staticUrlImage').$uploadForm->file;
            } else {
                return [
                    'code' => 1,
                    'message' => $uploadForm->getFirstErrorMessage()
                ];
            }
        }
    }

    /**
     * 修改资料
     */
    public function actionUpdateInfo()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $userId = Yii::$app->user->getId();
            $keys = ['birthday', 'gender', 'nickname'];
            foreach ($post as $k => $v) {
                if (!in_array($k, $keys)) {
                    unset($post[$k]);
                }
            }
            if (count($post) === 0) {
                return ;
            }
            if (isset($post['birthday'])) {
                $post['birthday'] = strtotime($post['birthday']);
            }
            Yii::$app->db->createCommand()
                ->update('core_user', $post, ['id' => $userId])
                ->execute();
        }
    }

    /**
     * 重置密码
     */
    public function actionResetPassword()
    {
        if (Yii::$app->request->isPost) {
            $resetPasswordForm = new ResetPasswordForm();
            if ($resetPasswordForm->load(Yii::$app->request->post(), '') && $resetPasswordForm->save()) {
                return true;
            } else {
                return [
                    'code' => 1,
                    'message' => $resetPasswordForm->getFirstErrorMessage()
                ];
            }
        }
    }


    /**
     * 收藏和取消收藏文章
     */
    public function actionToggleCollectArticle()
    {
        /*var_dump(Yii::$app->request->headers->get('Cookie'));
        list(, $sessionId) = explode('=', Yii::$app->request->headers->get('Cookie'));
        var_dump(session_id($sessionId));
        session_start();*/
        if (Yii::$app->user->isGuest) {
            return [
                'code' => 1,
                'message' => '未登录'
            ];
        }
        $userId = Yii::$app->user->getId();//echo 222;die;
        $articleId = Yii::$app->request->get('article_id');
//        var_dump($_SESSION);
//        var_dump($userId);die;
        $where = [
            'user_id' => $userId,
            'type_id' => $articleId,
            'type' => UserCollection::ARTICLE_TYPE
        ];
        $collection = UserCollection::find()->where($where)->one();
        if (!$collection) {
            $model = UserCollection::getInstance();
            if ($model->load($where, '') && $model->save()) {
                return true;
            } else {
                return [
                    'code' => 1,
                    'message' => $model->getFirstErrorMessage()
                ];
            }
        } else {
            $collection->delete();
        }

    }

    /**
     * 我收藏的文章
     */
    public function actionArticle() {
        if (Yii::$app->user->isGuest) {
            return [
                'code' => 1,
                'message' => '未登录'
            ];
        }
        $userId = Yii::$app->user->getId();
        $category = Yii::$app->request->get('category', 0);
        $keyword = Yii::$app->request->get('search');
        $article = Article::getInstance();
        $query = $article::find()->orderBy('core_article.create_by DESC, sort ASC')
            ->innerJoin(
                'core_user_collection',
//                [
//                    'core_user_collection.type_id' => 'core_article.id',
//                    'core_user_collection.user_id' => $userId,
//                    'core_user_collection.type' => 1
//                ]
                "core_user_collection.type_id=core_article.id and core_user_collection.user_id={$userId} and core_user_collection.type=1"
            )
            ->select([
                Article::tableName().'.id',
                'title',
                'description',
                Article::tableName().'.create_by',
                'cover'
                ,'source_name'
            ]);
        if (!empty($category)) {
            $query->andWhere(['category_id' => $category]);
        }
        if (!empty($keyword)) {
            $query->andWhere(['like', 'title', $keyword]);
        }

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $articles = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        //echo $query->createCommand()->getSql();die;
        return [
            'totalCount' => $count,
            'size' => Yii::$app->params['page.size'],
            'items' => $articles
        ];
    }


    public function actionComments()
    {
        $userId = Yii::$app->user->getId();
        $articleComment = ArticleComment::getInstance();
        $query = $articleComment::find()->orderBy(ArticleComment::tableName().'.create_by DESC')
            ->where(['user_id' => $userId])
            ->innerJoinWith('user')
            ->innerJoinWith('article')
            ->asArray();

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $comments = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        $staticImageUrl = Yii::getAlias('@staticUrlImage');
        $comments = array_map(function ($v) use ($staticImageUrl){
            if (isset($v['user'])) {
                $v['user']['avatar'] = $staticImageUrl.$v['user']['avatar'];
            }
            return $v;
        }, $comments);
        //echo $query->createCommand()->getRawSql();die;
        return [
            'totalCount' => (int)$count,
            'size' => Yii::$app->params['page.size'],
            'items' => $comments
        ];
    }


    //消息列表
    public function actionMessage()
    {
        if (Yii::$app->user->isGuest) {
            return [
                'code' => 1,
                'message' => '未登录'
            ];
        }

        $userId = Yii::$app->user->getId();
        $query = UserMessage::find()->where(['user_id' => $userId])->orderBy('create_by DESC')->asArray();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $messages = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        Yii::$app->db->createCommand("update ".UserMessage::tableName()." set is_read=1 where user_id=".$userId)->execute();
        return [
            'totalCount' => (int)$count,
            'size' => Yii::$app->params['page.size'],
            'items' => $messages
        ];
    }

    //消息未读数
    public function actionMessageUnreadNumber()
    {
        if (Yii::$app->user->isGuest) {
            return [
                'code' => 1,
                'message' => '未登录'
            ];
        }

        $userId = Yii::$app->user->getId();
        $count = UserMessage::getUnreadCountByUserId($userId);
        return ['unread_number' => $count];
    }

}