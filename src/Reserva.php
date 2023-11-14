<?php

class Reserva extends Model
{
    protected ?int $id;
    protected ?int $cliente_id;
    protected ?int $atividade_id;
    protected ?string $status;
    protected ?string $detalhesPagamento;
    protected ?string $comentarioCliente;

    public function __construct(int $cliente_id = null, int $atividade_id = null, string $status = '', string $detalhesPagamento = '', string $comentarioCliente = '')
    {
        // ... (código existente)
        parent::__construct('reservas', 'id');

        $this->cliente_id = $cliente_id;
        $this->atividade_id = $atividade_id;
        $this->status = $status;
        $this->detalhesPagamento = $detalhesPagamento;
        $this->id = null;
        $this->comentarioCliente = $comentarioCliente;

    }


    // public function __construct(int $cliente_id = null, int $atividade_id = null, string $status = '', string $detalhesPagamento = '')
    // {
    //     parent::__construct('reservas', 'id');

    //     $this->cliente_id = $cliente_id;
    //     $this->atividade_id = $atividade_id;
    //     $this->status = $status;
    //     $this->detalhesPagamento = $detalhesPagamento;
    //     $this->id = null;
    // }

     /**
     * Get the value of comentarioCliente
     */ 
    public function getComentarioCliente(): ?string
    {
        return $this->comentarioCliente;
    }

    /**
     * Set the value of comentarioCliente
     *
     * @return  self
     */ 
    public function setComentarioCliente(?string $comentarioCliente): self
    {
        $this->comentarioCliente = $comentarioCliente;

        return $this;
    }

    /**
     * Save only the comentarioCliente to the database
     */
    public function saveComentario()
    {
        if ($this->id) {
            $sql = "UPDATE {$this->tableName} SET comentarioCliente = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('si', $this->comentarioCliente, $this->id);
            $stmt->execute();
        }
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

    public static function find($id)
    {
        $classname = get_called_class();
        $object = new $classname();
    
        $sql = "SELECT * FROM " . $object->tableName . " WHERE " . $object->primaryKey . " = ?";
        $stmt = $object->connection->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return null;
        }
    
        $row = $result->fetch_assoc();
    
        if (!is_array($row)) {
            echo "Erro: A consulta não retornou um array associativo.";
            return null;
        }
    
        if (!isset($row[$object->primaryKey])) {
            echo "Erro: A chave primária não foi encontrada no resultado da consulta.";
            return null;
        }
    
        foreach ($row as $key => $value) {
            $object->$key = $value;
        }
    
        return $object;
    }


    public static function search(array $filters = []): array
{
    $classname = get_called_class();
    $object = new $classname();

    $sql = "SELECT * FROM " . $object->tableName;
    if (count($filters) > 0) {
        $sql .= " WHERE 1 = 1";

        foreach ($filters as $filter) {
            // Verifique se todos os elementos necessários estão presentes
            if (
                isset($filter['coluna']) &&
                isset($filter['operador']) &&
                isset($filter['valor'])
            ) {
                $sql .= " AND " . $filter['coluna']
                    . " " . $filter['operador']
                    . " '" . $filter['valor'] . "'";
            } else {
                // Adicione mensagens de depuração ou manipulação de erro conforme necessário
                // echo "Erro: Filtro inválido encontrado. Conteúdo do filtro: " . print_r($filter, true);
            }
        }
    }

    $sqlResult = $object->connection->query($sql);

    $resultados = [];
    while ($row = $sqlResult->fetch_assoc()) {
        $reserva = $classname::find($row[$object->primaryKey]);

        // Certifique-se de que $reserva não é nulo antes de adicioná-lo ao array
        if ($reserva) {
            $resultados[] = $reserva;
        } else {
            // Adicione mensagens de depuração ou manipulação de erro conforme necessário
            echo "Erro: Reserva não encontrada para a chave primária: " . $row[$object->primaryKey];
        }
    }

    return $resultados;
}

public static function deleteById($id)
{
    $classname = get_called_class();
    $object = new $classname();

    $sql = "DELETE FROM " . $object->tableName . " WHERE " . $object->primaryKey . " = ?";
    $stmt = $object->connection->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
}


    
    

}