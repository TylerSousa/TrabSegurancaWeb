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

    public static function search(array $filters = []): array
    {
        $classname = get_called_class();
        $object = new $classname();

        $sql = "select * from " . $object->tableName;
        if (count($filters) > 0) {
            $sql .= " where 1 = 1";

            foreach ($filters as $filter) {
                $sql .= " and  " . $filter['coluna']
                    . " " . $filter['operador']
                    . " '" . $filter['valor'] . "'";
            }
        }

        $sqlResult = $object->connection->query($sql);
        
        $resultados = [];
        while ($row = $sqlResult->fetch_assoc()) {
            $resultados[] = $classname::find($row[$object->primaryKey]);
        }
        
        return $resultados;
    }

    public static function find(int $id): ?Model
    {
        $classname = get_called_class();
        $model = new $classname();

        $sql = "select * from " . $model->tableName . " where "
            . $model->primaryKey . ' = ' . $id;

        $result = $model->connection->query($sql);
        if ($result->num_rows == 0) {
            return null;
        }

        $properties = get_class_vars(get_class($model));

        $campos = [];
        foreach ($properties as $propertie => $value) {
            if (in_array($propertie, ['connection', 'tableName', 'primaryKey','excludedProperties'])) {
                continue;
            }


            if (in_array($propertie, $model->excludedProperties)) {
                continue;
            }

            $campos[] = $propertie;
        }

        $row = $result->fetch_assoc();
        foreach ($campos as $pos => $campo) {
            $model->{$campo} = $row[$campo];
        }
        
        return $model;
    }
}