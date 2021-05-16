<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo DIRPAGE.'./assets/css/style.css'; ?>">

        <title>Project Upload Images</title>
    </head>
    <body>
        <div class="main">
            <form name="form" id="form" method="post" enctype="multipart/form-data" action="<?php echo DIRPAGE.'controllers/controllerAds'; ?>">
                <div class="fields">
                    <input type="hidden" id="action" name="action" value="add">
                </div>
                
                <div class="fields">
                    <input type="hidden" id="nextId" name="nextId" value="<?php echo $objAds->getNextId() ;?>">
                </div>
                
                <div class="fields">
                    <input type="text" name="title" id="title" placeholder="Título:" required>
                </div>

                <div class="fields">
                    <textarea name="content" id="content" placeholder="Conteúdo:" required></textarea>
                </div>
                
                <div class="divFiles"></div>
                
                <div class="bar"><div class="progress"></div></div>
                <div class="fields"><label class="filesLabel" for="files">
                    <input type="file" name="files[]" id="files"  accept="image/*" multiple>
                        Enviar arquivos</label></div>
                <div class="fields"><input type="submit" value="Salvar"></div>
            </form>
        </div>
    
        <script src="<?php echo DIRPAGE.'assets/js/javascript.js'; ?>"></script>
        <script>window.addEventListener('beforeunload',funcExitPage, false);</script>

    </body>
</html>