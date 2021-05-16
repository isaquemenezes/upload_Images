<?php
    namespace Classes;

    use Cocur\Slugify\Slugify;
    use Models\ModelCrud;

    class ClassUpload extends ModelCrud{

        private $file;
        private $slug;
        private $count;
        private $ads;
        private $dir;
        private $erro=[];
        private $rand;

        #Construct
        public function __construct(){
            
            $this->slug=new Slugify();
            $this->slug->addRule('.','yyy');
            $this->ads=new ClassAds();
            $this->rand=rand(0,100000);
        }

        #Getters and setters
        public function getFile(){  return $this->file; }
        public function setFile($file){$this->file = $file; }    

        public function getCount(){ return $this->count; }
        public function setCount($count){   $this->count = $count; }

        public function getDir(){   return $this->dir;  }
        public function setDir($dir){   $this->dir = $dir;  }

        public function getErro(){ return $this->erro; }
        public function setErro($erro){

            if(!in_array($erro, $this->getErro())){ array_push($this->erro, $erro); }
        }

        #Caminho absoluto do arquivo
        private function getAbsFile(){

            return $this->getDir().$this->rand.'_'.str_replace('yyy','.',$this->slug->slugify($this->getFile()['name'][$this->getCount()]));
        }

        #Get file extension - tratamento
        private  function getExtension(){

            $ext=explode(".",$this->getAbsFile());
            $ext=end($ext);
            return $ext;
            
        }

        #Move files
        public function moveFiles(){

            if($this->getExtension() === 'png' || $this->getExtension() === 'jpg' ){   //extersão permitida

                if($this->getFile()['size'][$this->getCount()] < 7000000){  //tamanho permitido

                    move_uploaded_file($this->getFile()['tmp_name'][$this->getCount()], $this->getAbsFile());
                    
                    $this->insertDB("files", "?,?,?",array(0, $this->ads->getNextId(), $this->getAbsFile()));
                
                }else{
                    $this->setErro("Arquivos ultrapassou 700000 !!!!!!");
                }      
            }else{  
                $this->setErro("Erro !!!!!!");
            }       

        }

        #select files by id
        private function selectFilesById($id){

            $bFiles=$this->selectDB("*", "files", "WHERE id=? ORDER BY id DESC", array($id));            
            return $fFiles=$bFiles->fetch(\PDO::FETCH_ASSOC); //fetch - pega apenas um registro 

        }
           
        #select files by fk
        public function selectFilesByFk($fk){

            $bFiles=$this->selectDB("*", "files", "WHERE fk_ads=? ORDER BY id DESC", array($fk));
            return $fFiles=$bFiles->fetchAll(\PDO::FETCH_ASSOC);

        }

        #show files table dinamica
        public function showFiles($fk){

                $html="<table class='tableUpload'>
                    <thead>
                        <tr>
                            <th>Arquivo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach($this->selectFilesByFk($fk) as $showFiles){
                $html.="<tr>
                            <td>$showFiles[path]</td>
                            <td>
                                <a href=''><img src='".DIRPAGE."assets/images/visualizar.png' data-src='$showFiles[path]' id='button-view' alt='Visualizar' data-fileid='$showFiles[id]'></a>
                                <a href=''><img src='".DIRPAGE."assets/images/excluir.jpg' id='button-trash' alt='Excluir' data-fileid='$showFiles[id]' data-filefk='$showFiles[fk_ads]'></a>
                            </td>
                        </tr>";

            }
                $html.="</tbody>
                    </table>";
                return $html;
        }

        #Delete the archives     
        public function deleteFiles($id){

            $fFiles=$this->selectFilesById($id);
            unlink(DIRREQ.$fFiles['path']);     //delete da pasta do servidor 
            $this->deleteDB("files", "id=?", array( $id ) );

        }
    }