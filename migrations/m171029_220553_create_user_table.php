<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m171029_220553_create_user_table extends Migration {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        /* Теблица Users */
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull(),
            'pass' => $this->string()->notNull(),
        ]);

        $this->insert('users', [
            'login' => 'admin',
            'pass' => '$2y$13$QSH6.rTkERorZCHIJFl6Cu1WXQLweHmQxFRUdgtN1OVRBSj5nCTuK',
        ]);

        $this->createIndex(
                'idx-users-login', 'users', 'login'
        );
        $this->createIndex(
                'idx-users-id', 'users', 'id'
        );

        /* Теблица Comment */
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'comments' => $this->string()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
                'fk-comment-id_user', 'comment', 'id_user', 'users', 'id', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        /* Удаление таблицы Users */
        $this->delete('users', ['id' => 1]);
        $this->dropIndex(
                'idx-users-login', 'users'
        );
        $this->dropIndex(
                'idx-users-id', 'users'
        );
        $this->dropTable('users');

        /* Удаление таблицы Comment */
        $this->dropForeignKey(
                'fk-comment-id_user', 'comment'
        );
        $this->dropTable('comment');
    }

}
