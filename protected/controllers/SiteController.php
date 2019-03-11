<?php

class SiteController extends Controller
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->pageTitle = 'Phone Book';
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/jscript/index/phonebook.js');
        $this->render('index');
    }

    /**
     * @param string $query
     * function to retrieve to relevant users according to the given query
     */
    public function actionFetchUsers($query = '')
    {
        if ($query == '') {
           $users = User::model()->findAll();
        }
        else
        {
            $criteria = new CDbCriteria;
            $criteria->with = [
                'company',
                'address',
            ];
            //fetch partial matches with all possible text fields
            $criteria->compare('t.name', $query, true,'OR');
            $criteria->compare('t.username', $query, true,'OR');
            $criteria->compare('t.phone', $query, true,'OR');
            $criteria->compare('t.website', $query, true,'OR');
            $criteria->compare('address.street', $query, true,'OR');
            $criteria->compare('address.suite', $query, true,'OR');
            $criteria->compare('address.city', $query, true,'OR');
            $criteria->compare('company.name', $query, true,'OR');
            $criteria->compare('company.catchPhrase', $query, true,'OR');
            $criteria->compare('company.bs', $query, true,'OR');

            $users = User::model()->findAll($criteria);
        }

        $usersData = [];
        foreach ($users as $user)
            $usersData[] = [
                'id' => $user->id,
                'name'=>$user->name,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address->city . ' - ' . $user->address->street,
            ];
        if ($users != [])
            //return JSON data with success true
            echo json_encode([
                'success' => true,
                'contacts' => $usersData,
            ]);
        else
            //return success false
            echo json_encode([
                'success' => false
            ]);
    }

}