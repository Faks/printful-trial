<?php

namespace App\Http\Database;

use PDO;
use PDOStatement;

use function implode;

/**
 * Class Model
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.21.
 * Time: 21:50
 */
class Model extends Connection
{
    /**
     * Get Current Table Name
     *
     * @var Model $table Get Table Name From Model
     */
    protected $table;
    
    /**
     * Get Last Insert Id
     *
     * @var integer $last_insert_id
     */
    public $last_insert_id;
    
    /**
     * Internal End Point
     *
     * @param  string  $query  Set Query
     *
     * @return false|PDOStatement
     */
    protected function query($query)
    {
        return $this->connection->query($query);
    }
    
    /**
     * Get All Records
     *
     * @param  string  $select_fields   Selecet Fields
     * @param  bool    $where_field     Fields
     * @param  bool    $where_operator  Operator
     * @param  bool    $where_value     Value
     * @param  bool    $and_where       Additional where
     * @param  bool    $join            Additional
     *
     * @return array
     */
    public function get($select_fields = "*", $where_field = false, $where_operator = false, $where_value = false, $and_where = false, $join = false)
    {
        $build_where_query = null;
        
        if ($where_field) {
            $build_where_query = 'WHERE ' . $where_field . ' ' . $where_operator . " '$where_value' ";
        }
        
        $build_and_where_query = null;
        
        if ($and_where) {
            $build_and_where_query = "AND  $and_where";
        }
        
        $build_join_query = null;
        
        if ($join) {
            $build_join_query = "$join";
        }
        
        $query = $this->query(
            "SELECT " . $select_fields . " FROM " . $this->table . " $build_join_query $build_where_query $build_and_where_query"
        );
        
        $data = [];
        
        while ($database_data = $query->fetch(PDO::FETCH_OBJ)) {
            $data[] = $database_data;
        }
        
        return $data;
    }
    
    /**
     * Get First Record From Database
     *
     * @param  string  $select_fields   Selecet Fields
     * @param  bool    $where_field     Fields
     * @param  bool    $where_operator  Operator
     * @param  bool    $where_value     Value
     * @param  bool    $to_object       Value
     *
     * @return mixed
     */
    public function first($select_fields = "*", $where_field = false, $where_operator = false, $where_value = false, $to_object = false)
    {
        $build_where_query = null;
        
        if ($where_field) {
            $build_where_query = 'WHERE ' . $where_field . ' ' . $where_operator . " '$where_value' ";
        }
        
        $base_query = $this->query(
            "SELECT " . $select_fields . " FROM " . $this->table . "
            $build_where_query LIMIT 1"
        );
        
        if ($to_object) {
            $query = $base_query->fetch(PDO::FETCH_OBJ);
        } else {
            $query = $base_query->fetch(PDO::FETCH_ASSOC);
        }
        
        return $query;
    }
    
    /**
     * Model Save
     *
     * @param  array  $fields_name   Fields Name
     * @param  array  $fields_value  Fields Values
     *
     * @return bool
     */
    public function save($fields_name, $fields_value)
    {
        if ($this->query(
                "INSERT INTO  " . $this->table . "
                (" . implode(', ', $fields_name) . ")
                VALUES (" . implode(', ', array_map('quote', $fields_value)) . ")"
            ) == true
        ) {
            $this->last_insert_id = $this->connection->lastInsertId();
            
            //return true if execute
            $status = true;
        } else {
            //return false if failed execute
            $status = false;
        }
        
        return $status;
    }
    
    /**
     * Model Update Record
     *
     * @param  string  $column_name_and_value  Colums and Values
     * @param  bool    $where_field            Fields
     * @param  bool    $where_operator         Operator
     * @param  bool    $where_value            Value
     * @param  bool    $and_where              Additional where
     *
     * @return bool
     */
    public function update($column_name_and_value, $where_field = false, $where_operator = false, $where_value = false, $and_where = false)
    {
        $build_and_where_query = null;
        if ($and_where) {
            $build_and_where_query = "AND  $and_where";
        }
        
        if ($this->query(
                "UPDATE  " . $this->table . " SET $column_name_and_value
            WHERE  $where_field $where_operator '$where_value' $build_and_where_query "
            ) == true
        ) {
            $this->last_insert_id = $this->connection->lastInsertId();
            
            //return true if execute
            $status = true;
        } else {
            //return false if failed execute
            $status = false;
        }
        
        return $status;
    }
    
    /**
     * Model Destroy Record
     *
     * @param  bool  $where_field     Fields
     * @param  bool  $where_operator  Operator
     * @param  bool  $where_value     Value
     *
     * @return bool
     */
    public function destroy($where_field = false, $where_operator = false, $where_value = false)
    {
        if ($this->query(
                "DELETE FROM  " . $this->table . "
            WHERE  $where_field $where_operator '$where_value' "
            ) == true
        ) {
            //return true if execute
            $status = true;
        } else {
            //return false if failed execute
            $status = false;
        }
        
        return $status;
    }
}
