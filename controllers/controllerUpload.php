<?php
    if($Action==='add'){
        for($i=0; $i<$Count; $i++){
            $objUpload->setFile($Files);
            $objUpload->setDir('assets/images/db/');
            $objUpload->setCount($i);
            $objUpload->moveFiles();

        }
        if(count($objUpload->getErro()) === 0){
            echo $objUpload->showFiles($NextId);
        }else{
            foreach($objUpload->getErro() as $err){
                echo $err.'<br>';
            }
        }
    }else{
        if($Action === 'delete'){

           $objUpload->deleteFiles($NextId); //delete the archive 
           echo $objUpload->showFiles($fkFiles);  //atualiza a table

        }
    }
  
