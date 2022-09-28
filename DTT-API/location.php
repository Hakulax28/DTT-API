<?php

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
                id, stad, adres, postcode, landcode, telefoon
            FROM
                locatie;
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
                id, stad, adres, postcode, landcode, telefoon
            FROM
                locatie
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
                (stad, adres, postcode, landcode, telefoon)
            VALUES
                (:stad, :adres, :postcode, :landcode, :telefoon);
        ";

      try {
         $statement = $this->db->prepare($statement);
         $statement->execute(array(
            'stad' => $input['stad'],
            'adres'  => $input['adres'],
            'postcode' => $input['postcode'],
            'landcode' => $input['landcode'],
            'telefoon' => $input['telefoon'],
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
            stad = :stad,
            adres  = :adres,
            postcode = :postcode,
            landcode = :landcode,
            telefoon = :telefoon,
            WHERE id = :id;
        ";

      try {
         $statement = $this->db->prepare($statement);
         $statement->execute(array(
            'id' => (int) $id,
            'stad' => $input['stad'],
            'adres'  => $input['adres'],
            'postcode' => $input['postcode'],
            'landcode' => $input['landcode'],
            'telefoon' => $input['telefoon'],
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
