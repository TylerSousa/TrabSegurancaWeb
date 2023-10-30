<?php

class Perfil extends Model
{   
    protected int $utilizador_id;
    protected string $nome;
    protected ?int $id;

    public function __construct(string $nome = '', int $utilizador_id)
    {
        parent::__construct('perfis', 'id');

        $this->nome = $nome;
        $this->utilizador_id = $utilizador_id;
        $this->id = null;
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
     * Get the value of utilizador_id
     */
    public function getUtilizadorId()
    {
        return $this->utilizador_id;
    }

    /**
     * Set the value of utilizador_id
     */
    public function setUtilizadorId(int $utilizador_id)
    {
        $this->utilizador_id = $utilizador_id;

        return $this;
    }
}