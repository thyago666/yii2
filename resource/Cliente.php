<?php


namespace app\resource;

class Cliente extends \app\models\Cliente
{

    public function fields(){

        return ['id','nome','cpf','endereco','foto','sexo','produtos'];
    }

    public function extraFields()
    {
        return ['criado_por'];
    }

    public function getProdutos()
    {
        return $this->hasMany(Produto::class, ['cliente_id' => 'id']);
    }
}