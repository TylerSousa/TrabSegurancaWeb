<?php

class Reserva extends Model
{
    protected ?int $id;
    protected ?int $cliente_id;
    protected ?int $atividade_id;
    protected ?string $status;
    protected ?string $detalhesPagamento;

    public function __construct(int $cliente_id = null, int $atividade_id = null, string $status = '', string $detalhesPagamento = '')
    {
        parent::__construct('reservas', 'id');

        $this->cliente_id = $cliente_id;
        $this->atividade_id = $atividade_id;
        $this->status = $status;
        $this->detalhesPagamento = $detalhesPagamento;
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
     * Get the value of cliente_id
     */ 
    public function getCliente_id()
    {
        return $this->cliente_id;
    }

    /**
     * Set the value of cliente_id
     *
     * @return  self
     */ 
    public function setCliente_id($cliente_id)
    {
        $this->cliente_id = $cliente_id;

        return $this;
    }

    /**
     * Get the value of atividade_id
     */ 
    public function getAtividade_id()
    {
        return $this->atividade_id;
    }

    /**
     * Set the value of atividade_id
     *
     * @return  self
     */ 
    public function setAtividade_id($atividade_id)
    {
        $this->atividade_id = $atividade_id;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of detalhesPagamento
     */ 
    public function getDetalhesPagamento()
    {
        return $this->detalhesPagamento;
    }

    /**
     * Set the value of detalhesPagamento
     *
     * @return  self
     */ 
    public function setDetalhesPagamento($detalhesPagamento)
    {
        $this->detalhesPagamento = $detalhesPagamento;

        return $this;
    }
}