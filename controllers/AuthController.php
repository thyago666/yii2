<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        
        // Aqui você fará a autenticação do usuário, verificando as credenciais
        // e gerando um token JWT para usuários válidos
        
        // Exemplo básico de autenticação
        if ($this->authenticate($username, $password)) {
            // Se as credenciais estiverem corretas, gera um token JWT
            $token = $this->generateToken($username);
            
            // Retorna o token como resposta
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['token' => $token];
        } else {
            // Se as credenciais estiverem incorretas, retorna uma mensagem de erro
            Yii::$app->response->statusCode = 401; // Unauthorized
            return ['error' => 'Credenciais inválidas'];
        }
    }
    
    // Função de autenticação de exemplo
    private function authenticate($username, $password)
    {
        // Implemente aqui a lógica de autenticação, como verificar no banco de dados
        // se o usuário e a senha correspondem a um usuário válido
        // Este é um exemplo básico
        return $username === 'admin' && $password === 'admin';
    }
    
    // Função para gerar token de exemplo
    private function generateToken($username)
    {
        // Implemente aqui a lógica para gerar um token JWT
        // Este é um exemplo básico usando a biblioteca firebase/php-jwt
        $payload = [
            'username' => $username,
            'exp' => time() + 3600 // Token expira em 1 hora
        ];
        return \Firebase\JWT\JWT::encode($payload, 'km5djmuDAecjiV_qGxdesiDVpPqaNWGC');
    }
}

