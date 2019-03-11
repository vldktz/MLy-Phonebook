<?php

class AddressController extends Controller
{
    /**
     * @param $id
     * function to update Address
     */
    public function actionUpdate($id)
    {
        $this->pageTitle = 'Update Address';
        $address = Address::model()->findByPk($id);
        if(isset($_POST['Address']))
        {
            $address->attributes = $_POST['Address'];
            if($address->validate())
            {
                $address->save();
                $user = User::model()->findByAttributes(['address_id'=>$address->address_id]);
                $this->redirect(Yii::app()->baseUrl . '/user/update/id/' . $user->id);
            }
        }
        $this->render('update',['address'=>$address]);
    }

    /**
     * @param $id
     * function to create Address
     */
    public function actionCreate($id)
    {
        $this->pageTitle = 'Create Address';
        $address = new Address;
        if(isset($_POST['Address']))
        {
            $address->attributes = $_POST['Address'];
            if($address->validate())
            {
                $address->save();
                $user = User::model()->findByPk($id);
                $user->address_id = $address->address_id;
                $user->save();
                $this->redirect(Yii::app()->baseUrl . '/user/update/id/' . $user->id);
            }
        }
        $this->render('update',['address'=>$address]);
    }
}