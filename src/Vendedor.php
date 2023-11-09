<?php

class Vendedor extends Model
{
    protected ?int $id;
    protected ?string $nome;
    protected ?string $email;
    protected array $atividadesGerenciadas;
    protected ?string $senha;

    public function __construct(string $nome = '', string $email = '')
    {
        parent::__construct('vendedores', 'id', ['atividadesGerenciadas']);

        $this->nome = $nome;
        $this->email = $email;
        $this->id = null;
        $this->atividadesGerenciadas = [];
        $this->senha = null; // Adicione um novo atributo para armazenar a senha
    }

    /**
     * Define a senha do vendedor
     *
     * @param string $senha
     */
    public function setSenha(string $senha)
    {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha (recomendado)
    }

    /**
     * Obtém a senha do vendedor
     *
     * @return string|null
     */
    public function getSenha()
    {
        return $this->senha;
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of atividadesGerenciadas
     */ 
    public function getAtividadesGerenciadas()
    {
        return $this->atividadesGerenciadas;
    }

    /**
     * Set the value of atividadesGerenciadas
     *
     * @return  self
     */ 
    public function setAtividadesGerenciadas($atividadesGerenciadas)
    {
        $this->atividadesGerenciadas = $atividadesGerenciadas;

        return $this;
    }
    }
