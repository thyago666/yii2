<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cliente}}`.
 */
class m240326_223038_create_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cliente}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(),
            'cpf' => $this->string(),
            'endereco' => $this->string(),
            'foto' => $this->string(),
            'sexo' => $this->string(1),
            'criado_por' => $this->integer(),
        ]);

        $this->addForeignKey('FK_cliente_user_criado_por', '{{%cliente}}', 'criado_por','{{%user}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cliente}}');
    }
}
