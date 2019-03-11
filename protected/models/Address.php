<?php

/**
 * This is the model class for table "{{addresses}}".
 *
 * The followings are the available columns in table '{{addresses}}':
 * @property integer $address_id
 * @property string $street
 * @property string $suite
 * @property string $city
 * @property string $zipcode
 * @property string $lat
 * @property string $lng
 *
 * The followings are the available model relations:

 * @property User[] $users
 */
class Address extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{addresses}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('street, suite, city, zipcode', 'required'),
            array('street, suite, city', 'length', 'max'=>256),
            array('lat, lng', 'length', 'max'=>128),
            array('zipcode', 'length', 'max'=>64),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('address_id, street, suite, city, zipcode, lat, lng', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'users' => array(self::HAS_MANY, 'User', 'address_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'address_id' => 'Address',
            'street' => 'Street',
            'suite' => 'Suite',
            'city' => 'City',
            'zipcode' => 'Zipcode',
            'lat' => 'Lat',
            'lng' => 'Long',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('address_id',$this->address_id);
        $criteria->compare('street',$this->street,true);
        $criteria->compare('suite',$this->suite,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('zipcode',$this->zipcode,true);
        $criteria->compare('lat',$this->zipcode);
        $criteria->compare('lng',$this->zipcode);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Address the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}