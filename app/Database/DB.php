<?php
class DB {
    private static $tipo = 'mysql';
    private static $port = '5432';
    private static $host = 'localhost';
    private static $dbname = 'biblio';
    private static $user = 'root';
    private static $pwd = '';

    protected static function connect() {
        try {
            if (self::$tipo == 'mysql') {
                $conexao = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname, self::$user, self::$pwd);
            }
            if (self::$tipo == 'pgsql') {
                $conexao = new PDO("pgsql:host=".self::$host.";port=".self::$port.";dbname=".self::$dbname.";user=".self::$user.";password=".self::$pwd);
            }
      
        /*$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);*/
        }
        catch (PDOException $e) {
            die("<div>" . $e->getMessage() . "</div>");
        }
        return ($conexao);
    }

    public static function insert($tabela, $data, $retorno = true) {
        $conn = self::connect();

        $query = "INSERT INTO $tabela (";
        $linhas = $values = $valuesExibir = "";
        $arrayValues = array();

        foreach ($data as $coluna => $dados) {
            if (!empty($dados)) {
                $linhas         .= (empty($linhas)) ? "" : ", ";
                $values         .= (empty($values)) ? "" : ", ";
                $valuesExibir   .= (empty($values)) ? "" : ", ";

                $linhas                     .= $coluna;
                $values                     .= ":".$coluna."";
                $valuesExibir               .= "'".addslashes(utf8_encode($dados))."'";
                $arrayValues[':'.$coluna]   = addslashes(utf8_encode($dados));
            }
        }
        try {
            $queryExibir = $query.$linhas.") VALUES (".$valuesExibir.")";
            $query .= $linhas.') VALUES ('.$values.')';
            $stm = $conn->prepare($query);
            $ret = $stm->execute($arrayValues);

        } catch (PDOException $e) {
            echo "ERROR: ".$e->getMessage();
            exit();
        }

        if ($ret) {
            return ($retorno) ? $conn->lastInsertId() : 1;
        }
        else {
            echo $queryExibir."<br>";
            var_dump($stm->errorInfo());
            exit();
            return 0;
        }
    }

    public static function update($tabela, $data, $where) {
        $conn = self::connect();

        if (empty($where)) {
            echo "Clausula where vazia!";
            exit();
        }

        $query = "UPDATE $tabela SET (";
        $linhas = $values = $valuesExibir = "";
        $arrayValues = array();

        foreach ($data as $coluna => $dados) {
            if (!empty($dados)) {
                $linhas         .= (empty($linhas)) ? "" : ", ";
                $valuesExibir   .= (empty($values)) ? "" : ", ";

                $linhas                     .= $coluna.' = :'.$coluna;
                $valuesExibir               .= $coluna." = '".addslashes(utf8_encode($dados))."'";
                $arrayValues[':'.$coluna]   = addslashes(utf8_encode($dados));
            }
        }
        try {
            $queryExibir = $query.$valuesExibir." WHERE ".$where;
            $query .= $linhas.' WHERE '.$where;
            $stm = $conn->prepare($query);
            $ret = $stm->execute($arrayValues);

        } catch (PDOException $e) {
            echo "ERROR: ".$e->getMessage();
            exit();
        }

        if ($ret) {
            return 1;
        }
        else {
            echo $queryExibir."<br>";
            var_dump($stm->errorInfo());
            exit();
            return 0;
        }
    }

    public static function select ($from, $rows = '*', $where = '') {
        $conn = self::connect();

        if (empty($rows)) {
            $rows = '*';
        }

        if (!empty($where)) {
            $where = "WHERE ".$where;
        }

        $query = "SELECT $rows FROM $from $where";
        $stm = $conn->prepare($query);
        $stm->execute();
        
        $data = array();
        if ($stm->rowCount() > 0) {

            foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $retorno = array();
                foreach ($row as $coluna => $dados) {
                    $retorno[$coluna] = utf8_decode($dados);
                }
                $data[] = $retorno;
            }
            return $data;
        }
        else {
            return 0;
        }
    }

    public static function get ($from, $where = '') {
        $conn = self::connect();

        if (!empty($where)) {
            $where = "WHERE ".$where;
        }

        $query = "SELECT * FROM $from $where";
        $stm = $conn->prepare($query);
        $stm->execute();

        if ($stm->rowCount() > 0) {
            return $stm->fetchObject();
        }
        else {
            return 0;
        }
    }

    public static function delete ($from, $where = '') {
        $conn = self::connect();

        if (empty($where)) {
            echo "Clausula where vazia!";
            exit();
        }

        $where = "WHERE ".$where;

        $query = "DELETE FROM $from $where";
        $stm = $conn->prepare($query);
        $ret = $stm->execute();

        if ($ret) {
            return 1;
        }
        else {
            return 0;
        }
    }

    public static function count($from, $where = '') {
        $conn = self::connect();

        if (!empty($where)) {
            $where = "WHERE ".$where;
        }

        $query = "SELECT * FROM $from $where";
        $stm = $conn->prepare($query);
        $stm->execute();
        
        return $stm->rowCount();
    }
}