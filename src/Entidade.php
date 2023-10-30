<?php
    class Entidade extends Model 
    {
        protected ?int $id;
        protected ?string $nome;
        protected ?string $nif;
        protected ?string $pais;

        public function __construct(string $nome = '', string $nif = '', string $pais = '')
        {
            parent::__construct('entidades', 'id');
            $this->id = null;
            $this->nome = $nome;
            $this->nif  = $nif;
            $this->pais = $pais;
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
        public function setNome(?string $nome)
        {
                $this->nome = $nome;

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
        public function setPais(?string $pais)
        {
                $this->pais = $pais;

                return $this;
        }


        /**
         * Get the value of nif
         */
        public function getNif()
        {
                return $this->nif;
        }

        /**
         * Set the value of nif
         */
        public function setNif(?string $nif)
        {
                $this->nif = $nif;

                return $this;
        }
    }
    
?>