<?php
    //Instância as variáveis e objetos
    $objCrud=new \Models\ModelCrud();
    $objAds=new \Classes\ClassAds();  
    $objUpload=new \Classes\ClassUpload();  
    
   
    if(isset($_POST['action'])){
        $Action=filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);
    }else{
        if(\Traits\TraitParseUrl::parseUrl(2) !== false){
            $Action = \Traits\TraitParseUrl::parseUrl(2); 
        }else{
            $Action="";
        }
    }    

    if(isset($_POST['nextId'])){
        $NextId=filter_input(INPUT_POST, "nextId", FILTER_SANITIZE_STRING);
    }else{
        if(\Traits\TraitParseUrl::parseUrl(3) !== false){
            $NextId = \Traits\TraitParseUrl::parseUrl(3); 
        }else{
            $NextId="";
        }
    }    

    if(isset($_POST['title'])){
        $Title=filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    }else{
        $Title=null;
    }

    if(isset($_POST['content'])){
        $Content=filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING);
    }else{
        $Content=null;
    }

    if(isset($_POST['date'])){
        $Date=filter_input(INPUT_POST, "date", FILTER_SANITIZE_STRING);
    }else{
        $Date=date("Y-m-d H:i:s");
    }

    if(isset($_FILES['files'])){
        $Files=$_FILES['files']; 
        $Count=count($Files['name']);
    }else{
        $Files=null;
        $Count=null;
    }

    if(\Traits\TraitParseUrl::parseUrl(4) != false){
        
        $fkFiles=\Traits\TraitParseUrl::parseUrl(4);

    }

    if(\Traits\TraitParseUrl::parseUrl(1) !== false){
        
        $idAds=\Traits\TraitParseUrl::parseUrl(1);
    }


   