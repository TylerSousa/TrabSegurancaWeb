<?php

abstract class Model
{
    protected $connection;

    protected string $tableName;
    protected string $primaryKey;
    protected array $excludedProperties;

    public function __construct(string $tableName, string $primaryKey, array $excludedProperties = [])
    {
        $this->connection = MyConnect::getInstance();
        $this->db = MyConnect::getInstance();
        $this->tableName = $tableName;
        $this->primaryKey = $primaryKey;
        $this->excludedProperties = $excludedProperties;
    }

    public function save()
    {
        $properties = get_class_vars(get_class($this));

        $campos = [];
        foreach ($properties as $propertie => $value) {
            if (in_array($propertie, ['connection', 'tableName', 'primaryKey','excludedProperties', 'id'])) {
                continue;
            }

            if (in_array($propertie, $this->excludedProperties)) {
                continue;
            }

            $campos[] = $propertie;
        }



        $sql = "insert into " . $this->tableName . ' ('
            . implode(",", $campos) . ') values (';
        
        foreach ($campos as $pos => $campo) {
            $sql .= "'" . $this->{$campo}
                . "'"
                . ($pos < count($campos)-1 ? ',' : '');
        }

        $sql .= ")";

        $this->connection->query($sql);
        $id = $this->connection->insert_id;

        $this->id = $id;
    }

    public static function find($id)
{
    $classname = get_called_class();
    $object = new $classname();

    $sql = "SELECT * FROM " . $object->tableName . " WHERE " . $object->primaryKey . " = ?";
    $stmt = $object->connection->prepare($sql);
    $stmt->bind_param('i', $id); // 'i' representa um inteiro
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return null;
    }

    $row = $result->fetch_assoc();

    // Adicione estas verificações
    if (!is_array($row)) {
        // Adicione mais informações de depuração, se necessário
        return null;
    }

    // Atualize as propriedades diretamente
    foreach ($row as $key => $value) {
        $object->$key = $value;
    }

    return $object;
}


}