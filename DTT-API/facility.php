<?php

namespace Src\TableGateways;

class PersonGateway
{

   private $db = null;

   public function __construct($db)
   {
      $this->db = $db;
   }

   public function findAll()
   {
      $statement = "
            SELECT 
                id, naam, creatie_datum, locatie_id, tag_id
            FROM
                facilities;
        ";

      try {
         $statement = $this->db->query($statement);
         $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
         return $result;
      } catch (\PDOException $e) {
         exit($e->getMessage());
      }
   }

   public function find($id)
   {
      $statement = "
            SELECT 
               id, naam, creatie_datum, locatie_id, tag_id
            FROM
               facilities
            WHERE id = ?;
        ";

      try {
         $statement = $this->db->prepare($statement);
         $statement->execute(array($id));
         $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
         return $result;
      } catch (\PDOException $e) {
         exit($e->getMessage());
      }
   }

   public function insert(array $input)
   {
      $statement = "
            INSERT INTO person 
                (naam, creatie_datum, locatie_id, tag_id)
            VALUES
                (:naam, :creatie_datum, :locatie_id, :tag_id);
        ";

      try {
         $statement = $this->db->prepare($statement);
         $statement->execute(array(
            'naam' => $input['naam'],
            'creatie_datum'  => $input['creatie_datum'],
            'locatie_id' => $input['locatie_id'] ?? null,
            'tag_id' => $input['tag_id'] ?? null,
         ));
         return $statement->rowCount();
      } catch (\PDOException $e) {
         exit($e->getMessage());
      }
   }

   public function update($id, array $input)
   {
      $statement = "
            UPDATE facilities
            SET 
            naam = :naam,
            creatie_datum  = :creatie_datum,
            locatie_id = :locatie_id,
            tag_id = :tag_id
            WHERE id = :id;
        ";

      try {
         $statement = $this->db->prepare($statement);
         $statement->execute(array(
            'id' => (int) $id,
            'naam' => $input['naam'],
            'lastname'  => $input['lastname'],
            'locatie_id' => $input['locatie_id'] ?? null,
            'tag_id' => $input['tag_id'] ?? null,
         ));
         return $statement->rowCount();
      } catch (\PDOException $e) {
         exit($e->getMessage());
      }
   }

   public function delete($id)
   {
      $statement = "
            DELETE FROM facilities
            WHERE id = :id;
        ";

      try {
         $statement = $this->db->prepare($statement);
         $statement->execute(array('id' => $id));
         return $statement->rowCount();
      } catch (\PDOException $e) {
         exit($e->getMessage());
      }
   }
}
