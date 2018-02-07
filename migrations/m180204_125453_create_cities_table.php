<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180204_125453_create_cities_table extends Migration {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        /* Теблица country */
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->insert('country', [
            'name' => 'Россия',
        ]);

        $this->createIndex(
                'idx-country-id', 'country', 'id'
        );
        $this->createIndex(
                'idx-country-name', 'country', 'name'
        );

        /* Теблица region */
        $this->createTable('region', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->insert('region', [
            'name' => 'Пермский край',
        ]);

        $this->createIndex(
                'idx-region-id', 'region', 'id'
        );
        $this->createIndex(
                'idx-region-name', 'region', 'name'
        );

        /* Теблица cities */
        $this->createTable('cities', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_country' => $this->integer()->notNull(),
            'id_region' => $this->integer()->notNull(),
        ]);

        $this->insert('cities', [
            'name' => 'Пермь',
            'id_country' => 1,
            'id_region' => 1,
        ]);

        $this->createIndex(
                'idx-citier-name', 'cities', 'name'
        );

        $this->addForeignKey(
                'fk-cities-id_country', 'cities', 'id_country', 'country', 'id', 'CASCADE'
        );
        $this->addForeignKey(
                'fk-region-id_region', 'cities', 'id_region', 'region', 'id', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        /* отчищаем таблицы */
        $this->delete('cities', ['id' => 1]);
        $this->delete('country', ['id' => 1]);
        $this->delete('region', ['id' => 1]);

        /* Удаление таблицы country */
        $this->dropIndex(
                'idx-country-id', 'country'
        );
        $this->dropIndex(
                'idx-country-name', 'country'
        );
        $this->dropTable('country');

        /* Удаление таблицы region */
        $this->dropIndex(
                'idx-region-id', 'region'
        );
        $this->dropIndex(
                'idx-region-name', 'region'
        );
        $this->dropTable('region');

        /* Удаление таблицы cities */
        $this->dropForeignKey(
                'fk-cities-id_country', 'cities'
        );
        $this->dropForeignKey(
                'fk-region-id_region', 'cities'
        );
        $this->dropIndex(
                'idx-citier-name', 'cities'
        );
        $this->dropTable('cities');
    }

}
