<?php

class Utilizador extends Model
{
    protected ?int $id;
    protected ?string $nome;
    protected ?string $email;
    protected ?int $perfil_id;
    protected array $logins;

    public function __construct(string $nome = '', string $email = '', int $perfil_id = null)
    {
        parent::__construct('utilizadores', 'id', ['logins']);

        $this->nome = $nome;
        $this->email = $email;
        $this->perfil_id = $perfil_id;
        $this->id = null;
        $this->logins = [];

    }


    // public function grava()
    // {
    //     $sql = "insert into utilizadores (nome,email,password) values ("
    //         . "'" . $this->nome . "', '" . $this->email . "', '"
    //         . $this->password . "');";

    //     $connection = MyConnect::getInstance();
    //     $result = $connection->query($sql);
    //     $this->id = $connection->insert_id;

    // }


    

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id)
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
     */
    public function setNome(?string $nome)
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
     */
    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }



    /**
     * Get the value of logins
     */
    public function getLogins(): array
    {
        return $this->logins;
    }

    /**
     * Set the value of logins
     */
    public function setLogins(array $logins)
    {
        $this->logins = $logins;

        return $this;
    }

    /**
     * Get the value of perfil_id
     */
    public function getPerfilId(): ?int
    {
        return $this->perfil_id;
    }

    /**
     * Set the value of perfil_id
     */
    public function setPerfilId(?int $perfil_id)
    {
        $this->perfil_id = $perfil_id;

        return $this;
    }
}