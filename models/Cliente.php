<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cliente}}".
 *
 * @property int $id
 * @property string|null $nome
 * @property string|null $cpf
 * @property string|null $endereco
 * @property string|null $foto
 * @property string|null $sexo
 * @property int|null $criado_por
 *
 * @property User $criadoPor
 * @property Produto[] $produtos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cliente}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cpf'], 'required'],
            [['cpf'], 'validateCPF'],
            [['criado_por'], 'integer'],
            [['nome','cpf', 'endereco', 'foto'], 'string', 'max' => 255],
            [['sexo'], 'string', 'max' => 1],
            [['criado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['criado_por' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cpf' => 'Cpf',
            'endereco' => 'Endereco',
            'foto' => 'Foto',
            'sexo' => 'Sexo',
            'criado_por' => 'Criado Por',
        ];
    }

    /**
     * Gets query for [[CriadoPor]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UserQuery
     */
    public function getCriadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'criado_por']);
    }

    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ProdutoQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::class, ['cliente_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ClienteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ClienteQuery(get_called_class());
    }

    public function validateCPF($attribute, $params)
    {
        $cpf = preg_replace('/[^0-9]/', '', $this->$attribute);

        if (strlen($cpf) != 11 ||
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            $this->addError($attribute, 'CPF inválido.');
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->addError($attribute, 'CPF inválido.');
                }
            }
        }
    }
}
