<?php

class Vendedor extends Model
{
    protected ?int $id;
    protected ?string $nome;
    protected ?string $email;
    protected ?string $password;
    protected ?string $designacao;
    protected ?string $rua;
    protected ?string $morada_codpostal;
    protected ?string $n_porta_andar;
    protected ?string $localidade;
    protected ?string $pais;
    protected ?string $NIF;
    protected ?string $situacao;
    protected ?string $hora_abertura;
    protected ?string $hora_fecho;
    protected ?string $dias_takeaway;
    protected ?string $dias_fechado;
    protected ?string $metodos_pagamento;
    protected ?string $telefone;
    protected ?string $webpage;
    protected ?string $responsavel;
    protected ?string $telefone_responsavel;
    protected ?int $utilizador_id;
    protected ?int $entidade_id;

    public function __construct(string $nome = '', string $email = '', string $password = '', string $designacao = '', string $rua = '', 
    string $morada_codpostal = '',string $n_porta_andar = '', string $localidade = '', string $pais = '', string $NIF = '', string $situacao = '', 
    string $hora_abertura = '', string $hora_fecho = '', string $dias_takeaway = '', string $dias_fechado = '', 
    string $metodos_pagamento = '' , string $telefone = '', string $webpage = '', string $responsavel = '',
    string $telefone_responsavel = '', int $utilizador_id = null, int $entidade_id = null)
    {
        parent::__construct('vendedores', 'id');
        $this->id = null;
        $this->nome = $nome;
        $this->email = $email;
        $this->password = $password;
        $this->designacao = $designacao;
        $this->rua = $rua;
        $this->morada_codpostal = $morada_codpostal;
        $this->n_porta_andar = $n_porta_andar;
        $this->localidade = $localidade;
        $this->pais = $pais;
        $this->NIF = $NIF;
        $this->situacao = $situacao;
        $this->hora_abertura = $hora_abertura;
        $this->hora_fecho = $hora_fecho;
        $this->dias_takeaway = $dias_takeaway;
        $this->dias_fechado = $dias_fechado;
        $this->metodos_pagamento = $metodos_pagamento;
        $this->telefone = $telefone;
        $this->webpage = $webpage;
        $this->responsavel = $responsavel;
        $this->telefone_responsavel = $telefone_responsavel;
        $this->utilizador_id = $utilizador_id;
        $this->entidade_id = $entidade_id;
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
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of designacao
     */
    public function getDesignacao()
    {
        return $this->designacao;
    }

    /**
     * Set the value of designacao
     */
    public function setDesignacao(string $designacao)
    {
        $this->designacao = $designacao;

        return $this;
    }

    /**
     * Get the value of rua
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * Set the value of rua
     */
    public function setRua(string $rua)
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Get the value of n_porta_andar
     */
    public function getNPortaAndar()
    {
        return $this->n_porta_andar;
    }

    /**
     * Set the value of n_porta_andar
     */
    public function setNPortaAndar(string $n_porta_andar)
    {
        $this->n_porta_andar = $n_porta_andar;

        return $this;
    }

    /**
     * Get the value of localidade
     */
    public function getLocalidade()
    {
        return $this->localidade;
    }

    /**
     * Set the value of localidade
     */
    public function setLocalidade(string $localidade)
    {
        $this->localidade = $localidade;

        return $this;
    }

    /**
     * Get the value of pais
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set the value of pais
     */
    public function setPais(string $pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get the value of NIF
     */
    public function getNIF()
    {
        return $this->NIF;
    }

    /**
     * Set the value of NIF
     */
    public function setNIF(string $NIF)
    {
        $this->NIF = $NIF;

        return $this;
    }

    /**
     * Get the value of situacao
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set the value of situacao
     */
    public function setSituacao(string $situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }

    /**
     * Get the value of hora_abertura
     */
    public function getHoraAbertura()
    {
        return $this->hora_abertura;
    }

    /**
     * Set the value of hora_abertura
     */
    public function setHoraAbertura(string $hora_abertura)
    {
        $this->hora_abertura = $hora_abertura;

        return $this;
    }

    /**
     * Get the value of hora_fecho
     */
    public function getHoraFecho()
    {
        return $this->hora_fecho;
    }

    /**
     * Set the value of hora_fecho
     */
    public function setHoraFecho(string $hora_fecho)
    {
        $this->hora_fecho = $hora_fecho;

        return $this;
    }

    /**
     * Get the value of dias_takeaway
     */
    public function getDiasTakeaway()
    {
        return $this->dias_takeaway;
    }

    /**
     * Set the value of dias_takeaway
     */
    public function setDiasTakeaway(string $dias_takeaway)
    {
        $this->dias_takeaway = $dias_takeaway;

        return $this;
    }

    /**
     * Get the value of metodos_pagamento
     */
    public function getMetodosPagamento()
    {
        return $this->metodos_pagamento;
    }

    /**
     * Set the value of metodos_pagamento
     */
    public function setMetodosPagamento(string $metodos_pagamento)
    {
        $this->metodos_pagamento = $metodos_pagamento;

        return $this;
    }

    /**
     * Get the value of telefone
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     */
    public function setTelefone(string $telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of webpage
     */
    public function getWebpage()
    {
        return $this->webpage;
    }

    /**
     * Set the value of webpage
     */
    public function setWebpage(string $webpage)
    {
        $this->webpage = $webpage;

        return $this;
    }

    /**
     * Get the value of responsavel
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * Set the value of responsavel
     */
    public function setResponsavel(string $responsavel)
    {
        $this->responsavel = $responsavel;

        return $this;
    }

    /**
     * Get the value of telefone_responsavel
     */
    public function getTelefoneResponsavel()
    {
        return $this->telefone_responsavel;
    }

    /**
     * Set the value of telefone_responsavel
     */
    public function setTelefoneResponsavel(string $telefone_responsavel)
    {
        $this->telefone_responsavel = $telefone_responsavel;

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
    public function setUtilizadorId(?int $utilizador_id){

        $this->utilizador_id = $utilizador_id;

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
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of morada_codpostal
     */
    public function getMoradaCodpostal()
    {
        return $this->morada_codpostal;
    }

    /**
     * Set the value of morada_codpostal
     */
    public function setMoradaCodpostal(string $morada_codpostal)
    {
        $this->morada_codpostal = $morada_codpostal;

        return $this;
    }

    /**
     * Get the value of entidade_id
     */
    public function getEntidadeId()
    {
        return $this->entidade_id;
    }

    /**
     * Set the value of entidade_id
     */
    public function setEntidadeId(?int $entidade_id)
    {
        $this->entidade_id = $entidade_id;

        return $this;
    }

    /**
     * Get the value of dias_fechado
     */
    public function getDiasFechado()
    {
        return $this->dias_fechado;
    }

    /**
     * Set the value of dias_fechado
     */
    public function setDiasFechado(?string $dias_fechado)
    {
        $this->dias_fechado = $dias_fechado;

        return $this;
    }
}   
