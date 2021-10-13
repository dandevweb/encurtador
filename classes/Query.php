<?php

class Query
{
    public static function insert($table, $values, $arr)
    {
        $insert = MySql::conectar()->prepare("INSERT INTO `$table` VALUES($values)");
        if ($insert->execute($arr)) {
            return true;
        } else {
            return false;
        }
    }

    public static function selectAll($table)
    {
        $select = MySql::conectar()->prepare("SELECT * FROM `$table`");
        $select->execute();
        return $select->fetchAll();
    }

    public static function selectAllWhere($table, $where, $arr)
    {
        $select = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $where");
        $select->execute($arr);
        return $select->fetchAll();
    }

    public static function selectWhere($table, $value, $arr)
    {
        $select = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $value");
        $select->execute($arr);
        return $select->fetch();
    }

    public static function update($table, $setters, $where, $arr)
    {
        $update = MySql::conectar()->prepare("UPDATE `$table` SET $setters WHERE $where");
        $update->execute($arr);
    }

    public static function delete($table, $where, $arr)
    {
        $del = MySql::conectar()->prepare("DELETE FROM `$table` WHERE $where");
        $del->execute($arr);
    }
}
