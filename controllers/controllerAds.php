<?php

    if($Action=='add'){
        $objCrud->insertDB("ads", "?,?,?,?", array($NextId, $Title, $Content, $Date));

        echo"<script>alert('Dados enviados com successo!');
                window.location.href='".DIRPAGE."anuncios/$NextId';
            </script>";    
    }else{
        if($Action=='closePage'){              
            //Fazendo um rascunho closePage vindo do javascript   controllers/controllerAds/closePage/'+doc.querySelector('#nextId').value)
            $objCrud->insertDB("ads", "?,?,?,?", array( $NextId, '', '', date("Y-m-d H:i:s")));
        }
    }