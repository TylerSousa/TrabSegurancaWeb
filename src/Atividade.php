<?php
class Atividade extends Model
{
    protected ?int $id;
    protected ?string $nome;
    protected ?string $descricao;
    protected ?float $preco;
    protected ?string $data;
    protected ?string $localizacao;
    protected ?int $vendedor_id;
    protected ?string $status = 'confirmado';
    
    public function __construct(string $nome = '', string $descricao = '', float $preco = 0.0, string $data = '', string $localizacao = '')
    {
            parent::__construct('atividades', 'id');
    
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->data = $data;
            $this->localizacao = $localizacao;
            $this->id = null;
            $this->vendedor_id = null;
        }

      /**
     * Set the value of status
     *
     * @param string $status
     * @return self
     */
    public function setEstado($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the value of status
     *
     * @return string|null
     */
    public function getEstado()
    {
        return $this->status;
    }
    /**
     * Get the value of vendedor_id
     */ 
    public function getVendedorId()
    {
        return $this->vendedor_id;
    }

    /**
     * Set the value of vendedor_id
     *
     * @return  self
     */ 
    public function setVendedorId($vendedor_id)
    {
        $this->vendedor_id = $vendedor_id;
        return $this;
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

    if (!empty($filters)) {
        $sql .= " WHERE 1 = 1";

        foreach ($filters as $key => $value) {
            // Certifique-se de escapar os valores para evitar injeção de SQL
            $value = $object->connection->real_escape_string($value);

            $sql .= " AND $key = '$value'";
        }
    }

    $sqlResult = $object->connection->query($sql);

    $resultados = [];
    while ($row = $sqlResult->fetch_assoc()) {
        $atividade = $classname::find($row[$object->primaryKey]);

        if ($atividade) {
            $resultados[] = $atividade;
        } else {
            // Lógica para lidar com atividades não encontradas, se necessário
        }
    }

    return $resultados;
}

    

public function update()
{
    if ($this->id) {
        // Verifique se a atividade tem um ID antes de tentar atualizá-la
        $sql = "UPDATE {$this->tableName} SET
                    nome = ?,
                    descricao = ?,
                    preco = ?,
                    data = ?,
                    localizacao = ?,
                    status = ?  -- Adicione a atualização do status
                WHERE id = ?";
        $params = [
            $this->nome,
            $this->descricao,
            $this->preco,
            $this->data,
            $this->localizacao,
            $this->status, // Atualização do status
            $this->id
        ];
        $stmt = $this->db->prepare($sql);

        // "ssdsssi" representa os tipos dos parâmetros: string, string, double, string, string, string, int
        $stmt->bind_param("ssdsssi", ...$params);
        $stmt->execute();

        return true; // Retorne true para indicar sucesso na atualização
    }

    return false; // Retorne false se não houver ID válido para a atividade
}


public static function find($id)
{
    $classname = get_called_class();
    $object = new $classname();

    $sql = "SELECT * FROM " . $object->tableName . " WHERE id = ?";
    $stmt = $object->db->prepare($sql);
    $stmt->bind_param('i', $id); // 'i' representa um inteiro
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $instance = new $classname();

        // Atualize as propriedades diretamente
        foreach ($row as $key => $value) {
            $instance->$key = $value;
        }

        return $instance;
    }

    return null;
}

public static function getAtividadeByIdAndVendedor($atividade_id, $vendedor_id)
{
    $object = new self();
    $sql = "SELECT * FROM {$object->tableName} WHERE id = ? AND vendedor_id = ?";
    $stmt = $object->db->prepare($sql);
    $stmt->bind_param('ii', $atividade_id, $vendedor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $instance = new self();

        // Atualize as propriedades diretamente
        foreach ($row as $key => $value) {
            $instance->$key = $value;
        }

        return $instance;
    }

    return null;
}
}