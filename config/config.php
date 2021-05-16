<?php
    //Caminhos Absolutos
    #Pasta Interna
    $pastaInterna="upload_Images/";
    #Caminho da url
    define("DIRPAGE", "http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");
    #Configuração para a barra 
    (substr($_SERVER['DOCUMENT_ROOT'], -1)== '/') ? $barra="" : $barra="/";
    #Caminho físico 
    define("DIRREQ", "{$_SERVER['DOCUMENT_ROOT']}{$barra}{$pastaInterna}");

    #atalhos
    define("DIRIMG", DIRPAGE."upload_Images/assets/images/");
    define("DIRCSS", DIRPAGE."upload_Images/assets/css/");
    define("DIRJS", DIRPAGE."upload_Images/assets/js/");

    #Dados de acesso ao DB
    define("HOST", "localhost");//servidor
    define("DB", "app");        //banco de dados
    define("USER", "root");     //usuário
    define("PASS", "");         //senha



