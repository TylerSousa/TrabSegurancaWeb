<?php
class Administrador extends Model 
{
    protected ?int $id;
    protected ?string $email;
    protected ?string $password;
    protected ?int $utilizador_id;

    public function __construct(string $email = '', string $password = '', int $utilizador_id = null)
    {
        parent::__construct('administradores', 'id');
        $this->id = null;
        $this->email = $email;
        $this->password = $password;
        $this->utilizador_id = $utilizador_id;
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
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

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
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of utilizador_id
     */
    public function getUtilizadorId(): ?int
    {
        return $this->utilizador_id;
    }

    /**
     * Set the value of utilizador_id
     */
    public function setUtilizadorId(?int $utilizador_id): self
    {
        $this->utilizador_id = $utilizador_id;

        return $this;
    }
}
