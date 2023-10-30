<?php
    class Cliente extends Model
    {
        protected ?int $id;
        protected ?string $nome;
        protected ?string $rua;
        protected ?string $n_porta_andar;
        protected ?string $morada_codpostal;
        protected ?string $localidade;
        protected ?string $país;
        protected ?string $telemovel;
        protected ?string $NIF;
        protected ?string $email;
        protected ?string $password;
        protected ?string $estado;
        protected ?int $utilizador_id;

        public function __construct(string $nome = '', string $rua = '', string $n_porta_andar = '', string $morada_codpostal = '',
        string $localidade = '', string $país = '', string $telemovel = '', string $NIF = '', string $email = '',
        string $password = '', string $estado = '', string $utilizador_id = null)
        {
            parent::__construct('clientes', 'id');
            $this->id = null;
            $this->nome = $nome;
            $this->rua = $rua;
            $this->n_porta_andar = $n_porta_andar;
            $this->morada_codpostal = $morada_codpostal;
            $this->localidade = $localidade;
            $this->país = $país;
            $this->telemovel = $telemovel;
            $this->NIF = $NIF;
            $this->email = $email;
            $this->password = $password;
            $this->estado = $estado;
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
         * Get the value of nome
         */
        public function getNome(): ?string
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         */
        public function setNome(?string $nome): self
        {
                $this->nome = $nome;

                return $this;
        }

        /**
         * Get the value of rua
         */
        public function getRua(): ?string
        {
                return $this->rua;
        }

        /**
         * Set the value of rua
         */
        public function setRua(?string $rua): self
        {
                $this->rua = $rua;

                return $this;
        }

        /**
         * Get the value of n_porta_andar
         */
        public function getNPortaAndar(): ?string
        {
                return $this->n_porta_andar;
        }

        /**
         * Set the value of n_porta_andar
         */
        public function setNPortaAndar(?string $n_porta_andar): self
        {
                $this->n_porta_andar = $n_porta_andar;

                return $this;
        }

        /**
         * Get the value of morada_codpostal
         */
        public function getMoradaCodpostal(): ?string
        {
                return $this->morada_codpostal;
        }

        /**
         * Set the value of morada_codpostal
         */
        public function setMoradaCodpostal(?string $morada_codpostal): self
        {
                $this->morada_codpostal = $morada_codpostal;

                return $this;
        }

        /**
         * Get the value of localidade
         */
        public function getLocalidade(): ?string
        {
                return $this->localidade;
        }

        /**
         * Set the value of localidade
         */
        public function setLocalidade(?string $localidade): self
        {
                $this->localidade = $localidade;

                return $this;
        }


        /**
         * Get the value of telemovel
         */
        public function getTelemovel(): ?string
        {
                return $this->telemovel;
        }

        /**
         * Set the value of telemovel
         */
        public function setTelemovel(?string $telemovel): self
        {
                $this->telemovel = $telemovel;

                return $this;
        }

        /**
         * Get the value of NIF
         */
        public function getNIF(): ?string
        {
                return $this->NIF;
        }

        /**
         * Set the value of NIF
         */
        public function setNIF(?string $NIF): self
        {
                $this->NIF = $NIF;

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
         * Get the value of estado
         */
        public function getEstado(): ?string
        {
                return $this->estado;
        }

        /**
         * Set the value of estado
         */
        public function setEstado(?string $estado): self
        {
                $this->estado = $estado;

                return $this;
        }

        /**
         * Get the value of utilizador_id
         */
        public function getUtilizadorId(): ?string
        {
                return $this->utilizador_id;
        }

        /**
         * Set the value of utilizador_id
         */
        public function setUtilizadorId(?string $utilizador_id): self
        {
                $this->utilizador_id = $utilizador_id;

                return $this;
        }

        /**
         * Get the value of pais
         */
        public function getPais(): ?string
        {
                return $this->país;
        }

        /**
         * Set the value of pais
         */
        public function setPais(?string $país): self
        {
                $this->país = $país;

                return $this;
        }
    }
    

?>