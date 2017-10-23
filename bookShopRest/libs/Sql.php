<?php

 class Sql
 {

     private $select;
     private $from;
     private $where;
     private $insert;
     private $values;
     private $delete;
     private $update;
     private $set;

     public function flag($flag)
     {
         $this->flag = $flag;
         return $this;
     }

     public function select($select)
     {
         $this->select = 'SELECT ' . $select;
         return $this;
     }

     public function from($table)
     {
         $this->from = ' FROM ' . $table;
         return $this;
     }

     public function where($key, $value)
     {
         $this->where = " WHERE $key=" . "'" . $value . "'";
         return $this;
     }

     public function insert($table, $data)
     {
         $this->insert = "INSERT INTO " . "$table  ($data)";
         return $this;
     }

     public function values($data)
     {
         $this->values = " VALUES ('" . $data . "')";
         return $this;
     }

//DELETE

     public function delete()
     {
         $this->delete = "DELETE ";
         return $this;
     }

//UPDATE
     public function update($table)
     {
         $this->update = "UPDATE " . $table;
         return $this;
     }

     public function set($data, $value)
     {
         $this->set = " SET " . $data . "='" . $value . "'";
         return $this;
     }

//EXEC
     public function exec()
     {
//SELECT
         if (
             !empty($this->select) 
             && !empty($this->from) 
//             && !empty($this->where) 
         )
         {
             $this->query = $this->select . $this->from . $this->where;
//             var_dump($this->query);
             return $this->query;
         } 
//INSERT
         if (
             !empty($this->insert) 
             && !empty($this->values) 
             
         )
         {
             $this->query = $this->insert . $this->values;
//             var_dump($this->query);
             return $this->query;
         }

//DELETE
         if (
             !empty($this->delete) 
             && !empty($this->from) 
             && !empty($this->where) 
         )
         {
             $this->query = $this->delete . $this->from . $this->where;
             return $this->query;
         }

//UPDATE
         if (
             !empty($this->update) 
             && !empty($this->set) 
             && !empty($this->where) 
         )
         {

             $this->query = $this->update . $this->set . $this->where;
             return $this->query;
         }
     }

 }

?>
