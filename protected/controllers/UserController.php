<?php

class UserController extends Controller
{
    /**
     * @param null $id
     * function to delete User async
     */
    public function actionDelete($id = null)
    {
        if($id === null)
        {
            echo json_encode(['success'=>false]);
            Yii::app()->end();
        }
        User::model()->deleteByPk($id);
        echo json_encode(['success'=>true]);
    }

    /**
     * @param $id
     * function to update User
     */
    public function actionUpdate($id)
    {
        $this->pageTitle = 'Update User';
        $user = User::model()->with([ 'company','address'])->findByPk($id);
        if(isset($_POST['User']))
        {
            $user->attributes = $_POST['User'];
            if($user->validate())
            {
                $user->save();
                $this->redirect(Yii::app()->homeUrl);
            }
        }
        $this->render('update',['user'=>$user]);
    }

    /**
     * function to create User
     */
    public function actionCreate()
    {
        $this->pageTitle = 'Create User';
        $user = new User;
        if(isset($_POST['User']))
        {
            $user->attributes = $_POST['User'];
            if($user->validate())
            {
                $user->save();
                $this->redirect(Yii::app()->homeUrl);
            }
        }
        $this->render('create',['user'=>$user]);
    }
}