<?php

class CompanyController extends Controller
{
    /**
     * @param $id
     * function to update Company
     */
    public function actionUpdate($id)
    {
        $this->pageTitle = 'Update Company';
        $company = Company::model()->findByPk($id);
        if(isset($_POST['Company']))
        {
            $company->attributes = $_POST['Company'];
            if($company->validate())
            {
                $company->save();
                $user = User::model()->findByAttributes(['company_id'=>$company->company_id]);
                $this->redirect(Yii::app()->baseUrl . '/user/update/id/' . $user->id);
            }
        }
        $this->render('update',['company'=>$company]);
    }

    /**
     * @param $id
     * function to create Company
     */
    public function actionCreate($id)
    {
        $this->pageTitle = 'Creat Company';
        $company = new Company;
        if(isset($_POST['Company']))
        {
            $company->attributes = $_POST['Company'];
            if($company->validate())
            {
                $company->save();
                $user = User::model()->findByPk($id);
                $user->company_id = $company->company_id;
                $user->save();
                $this->redirect(Yii::app()->baseUrl . '/user/update/id/' . $user->id);
            }
        }
        $this->render('update',['company'=>$company]);
    }
}