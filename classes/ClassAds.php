<?php
    namespace Classes;

    use Models\ModelCrud;

    class ClassAds extends ModelCrud{

        public function selectAdsById($id){

            $bFiles=$this->selectDB("*", "ads", "WHERE id=? ORDER BY id DESC", array($id));

            return $fFiles=$bFiles->fetch(\PDO::FETCH_ASSOC); //fetch - pega apenas um registro 
        }
        
        #Get next id table ads
        public function getNextId(){
            $b=$this->selectDB("id", "ads", "ORDER BY id DESC", array( ));

            $f=$b->fetch(\PDO::FETCH_ASSOC);  // pegando as colunas e linhas 
            
            $row=$b->rowCount();              // Contando a quantidade total de linhas
            /*if($row > 0){ $result = $f['id']+1; }       //Soma mais 1 , ou seja , o next id. VAi ser inserido no DB
            else{ $result=1;  }
            return $result;*/
            // Operador ternário
            return ($row>0)?$f['id']+1:1;
        }

        
    }