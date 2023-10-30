<?php

class Acesso extends Model 
{
    protected ?int $id;
    protected ?int $utilizador_id;
    protected ?string $data;
    protected ?bool $sucesso;
    protected ?string $ip;
    protected ?string $agent;

    public function __construct(int $utilizador_id = null, string $data, bool $sucesso = false)
    {
        parent::__construct('acessos', 'id');

        $this->utilizador_id = $utilizador_id;
        $this->data = $data;
        $this->sucesso = $sucesso;
        $this->ip = '';
        $this->agent = '';
        
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
     */
    public function setId(?int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the value of sucesso
     */
    public function isSucesso()
    {
        return $this->sucesso;
    }

    /**
     * Set the value of sucesso
     */
    public function setSucesso(?bool $sucesso)
    {
        $this->sucesso = $sucesso;

        return $this;
    }

    /**
     * Get the value of ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Get the value of agent
     */
    public function getAgent()
    {
        return $this->agent;
    }
}
