<?php
namespace Models;

abstract class ModelConexao{

    #Connect to database
    protected function conectaDB()
    {
        try{
            return $con=new \PDO("mysql:host=".HOST.";dbname=".DB."",USER,PASS);
        }catch (\PDOException $erro){
            return $erro->getMessage();
        }
    }
}
