<?php


namespace app\resource;

class Produto extends \app\models\Produto
{

    public function fields(){

        return ['id','nome','preco','foto','cliente_id'];
    }

    public function extraFields()
    {
        return ['cliente'];
    }

    public function getCliente()
    {
        return $this->hasOne(Cliente::class, ['id' => 'cliente_id']);
    }
}