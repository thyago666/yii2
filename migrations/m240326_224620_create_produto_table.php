<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%produto}}`.
 */
class m240326_224620_create_produto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%produto}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(),
            'preco' => $this->string(),
            'cliente_id' => $this->integer(),
            'foto' => $this->string(),
        ]);
        $this->addForeignKey('FK_produto_cliente_cliente_id', '{{%produto}}', 'cliente_id','{{%cliente}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%produto}}');
    }
}
