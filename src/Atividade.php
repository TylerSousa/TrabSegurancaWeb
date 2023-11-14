<?php

class Atividade extends Model
{
    protected ?int $id;
    protected ?string $nome;
    protected ?string $descricao;
    protected ?float $preco;
    protected ?string $data;
    protected ?string $localizacao;
    
        public function __construct(string $nome = '', string $descricao = '', float $preco = 0.0, string $data = '', string $localizacao = '')
        {
            parent::__construct('atividades', 'id');
    
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->data = $data;
            $this->localizacao = $localizacao;
            $this->id = null;
        }

    // Outros métodos e propriedades necessários

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
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of preco
     */ 
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */ 
    public function setPreco($preco)
    {
        $this->preco = $preco;

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
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of localizacao
     */ 
    public function getLocalizacao()
    {
        return $this->localizacao;
    }

    /**
     * Set the value of localizacao
     *
     * @return  self
     */ 
    public function setLocalizacao($localizacao)
    {
        $this->localizacao = $localizacao;

        return $this;
    }

    public function delete()
    {
        if ($this->id) {
            // Verifique se a atividade tem um ID antes de tentar excluí-la
            $sql = "DELETE FROM {$this->tableName} WHERE id = ?";
            $params = [$this->id];
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $this->id); // 'i' representa um inteiro
            $stmt->execute();

            // Defina o ID como nulo para indicar que a atividade foi excluída
            $this->id = null;

            return true; // Retorne true para indicar sucesso na exclusão
        }

        return false; // Retorne false se não houver ID válido para a atividade
    }

    public static function search(array $filters = []): array
    {
        $classname = get_called_class();
        $object = new $classname();

        $sql = "SELECT * FROM " . $object->tableName;
        if (count($filters) > 0) {
            $sql .= " WHERE 1 = 1";

            foreach ($filters as $filter) {
                $sql .= " AND " . $filter['coluna']
                    . " " . $filter['operador']
                    . " '" . $filter['valor'] . "'";
            }
        }

        $sqlResult = $object->connection->query($sql);

        $resultados = [];
        while ($row = $sqlResult->fetch_assoc()) {
            $instance = new $classname();

            // Atualize as propriedades diretamente
            foreach ($row as $key => $value) {
                $instance->$key = $value;
            }

            $resultados[] = $instance;
        }

        return $resultados;
    }
}
