<?php
class Cliente extends Model
{
    protected ?int $id;
    protected ?string $nome;
    protected ?string $email;
    protected ?string $senha;
    protected ?string $cartaoCredito;
    
    public function __construct(string $nome = '', string $email = '', string $senha = '', string $cartaoCredito = '')
    {
        parent::__construct('clientes', 'id');
        
        $this->id = null;
        $this->nome = $nome;
        $this->email = $email;
        $this->setSenha($senha); // Chamada a função para criar o hash da senha.
        $this->cartaoCredito = $cartaoCredito;
    }

    public function setSenha(string $senha)
    {
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function verificarSenha(string $senha)
    {
        return password_verify($senha, $this->senha);
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha(): ?string
    {
        return $this->senha;
    }

    /**
     * Get the value of cartaoCredito
     */ 
    public function getCartaoCredito(): ?string
    {
        return $this->cartaoCredito;
    }

    /**
     * Set the value of cartaoCredito
     *
     * @return  self
     */ 
    public function setCartaoCredito(?string $cartaoCredito): self
    {
        $this->cartaoCredito = $cartaoCredito;

        return $this;
    }
}
?>
