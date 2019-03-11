<?php

class m190310_165426_import_db extends CDbMigration
{
    public function up()
    {
        //create DB//
        $this->execute("CREATE TABLE `tbl_users` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(256) NOT NULL , `username` VARCHAR(256) NOT NULL , `email` VARCHAR(256) NULL DEFAULT NULL , `phone` VARCHAR(32) NOT NULL , `website` VARCHAR(256) NULL DEFAULT NULL , `address_id` INT NULL DEFAULT NULL , `company_id` INT NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        $this->execute("CREATE TABLE `tbl_companies` ( `company_id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(256) NOT NULL , `catchPhrase` VARCHAR(256) NOT NULL , `bs` VARCHAR(256) NOT NULL , PRIMARY KEY (`company_id`)) ENGINE = InnoDB;");
        $this->execute("CREATE TABLE `tbl_addresses` ( `address_id` INT NOT NULL AUTO_INCREMENT , `street` VARCHAR(256) NOT NULL , `suite` VARCHAR(256) NOT NULL , `city` VARCHAR(256) NOT NULL , `zipcode` VARCHAR(64) NOT NULL , `lat` VARCHAR(128) NULL DEFAULT NULL , `lng` VARCHAR(128) NULL DEFAULT NULL , PRIMARY KEY (`address_id`)) ENGINE = InnoDB;");
        $this->execute("ALTER TABLE `tbl_users` ADD INDEX( `address_id`, `company_id`);");
        $this->execute("ALTER TABLE `tbl_users` ADD FOREIGN KEY (`address_id`) REFERENCES `tbl_addresses`(`address_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;");
        $this->execute("ALTER TABLE `tbl_users` ADD FOREIGN KEY (`company_id`) REFERENCES `tbl_companies`(`company_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;");

        //populate DB//
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'jsonplaceholder.typicode.com/users');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $result = json_decode($response, true);
        foreach ($result as $data) {
            //user init//
            $user = new User;
            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->phone = $data['phone'];
            $user->website = $data['website'];

            //address init
            $address = new Address;
            $address->street = $data['address']['street'];
            $address->suite = $data['address']['suite'];
            $address->city = $data['address']['city'];
            $address->zipcode = $data['address']['zipcode'];
            $address->lat = $data['address']['geo']['lat'];
            $address->lng = $data['address']['geo']['lng'];
            $address->save();

            $user->address_id = $address->address_id;
            //company init
            $company = new Company;
            $company->name = $data['company']['name'];
            $company->catchPhrase = $data['company']['catchPhrase'];
            $company->bs = $data['company']['bs'];
            $company->save();

            $user->company_id = $company->company_id;
            $user->save();

        }
    }

    public function down()
    {
        echo "m190310_165426_import_db does not support migration down.\n";
        return false;
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}