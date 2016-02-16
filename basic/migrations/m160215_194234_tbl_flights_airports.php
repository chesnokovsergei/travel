<?php

use yii\db\Migration;

class m160215_194234_tbl_flights_airports extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'flights',
            array(
                'id' => 'pk',
                'from' => 'int',
                'to' => 'int',
                'back' => 'tinyint(1) unsigned default "0" ',
                'start' => 'date default NULL',
                'stop' => 'date default NULL',
                'adult' => 'tinyint(1) unsigned default "0" ',
                'child' => 'tinyint(1) unsigned default "0" ',
                'infant' => 'tinyint(1) unsigned default "0" ',
                'price' => 'decimal(12, 2) default "0.00" ',
            )
        );

        $this->createTable(
            'airports',
            array(
                'id' => 'pk',
                'code' => 'varchar(3) default "" ',
                'name' => 'varchar(64) default "" ',
                'country' => 'smallint(6) unsigned default "0" ',
            )
        );

        $this->addForeignKey(
            'fk__flights__from__x__airports__id',
            'flights',
            'from',
            'airports',
            'id'
        );

        $this->addForeignKey(
            'fk__flights__to__x__airports__id',
            'flights',
            'to',
            'airports',
            'id'
        );

        $this->insert('airports', array(
            'code' => 'DME',
            'name' => 'Domodedovo',
            'country' => '1'
        ));

        $this->insert('airports', array(
            'code' => 'OVB',
            'name' => 'Tolmachevo',
            'country' => '1'
        ));

    }

    public function down()
    {
        echo "m160215_194234_tbl_flights_airports cannot be reverted.\n";
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
