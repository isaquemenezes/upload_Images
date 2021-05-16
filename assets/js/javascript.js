(function readyJS(win,doc){
    'use strict'

    //Get absolute path
    function getRoot(){

        return win.location.protocol+"//"+doc.location.hostname+"/upload_Images/"
    }

    //Upload
    function upload(){

        let ajax=new XMLHttpRequest()
        let formData=new FormData(doc.querySelector('#form'))
        let bar=doc.querySelector('.bar')
        let progress=doc.querySelector('.progress')

        ajax.open('POST',getRoot()+'controllers/controllerUpload')

        //Barra de progresão de envio de arquivos
        ajax.upload.onprogress=function(event){
            if(event.lengthComputable){
                if(event.loaded+'/'+event.total){
                    
                    bar.style.display='block' // mostra na tela
                    progress.style.width=((event.loaded*100) / event.total)+"%"

                }
            }
        }
        
        //Alerta para mensagem ao usuário - quanto ao envio de arquivos
        ajax.onloadend=function(){
            bar.style.display='none'  // quando carrega a imagem, some com a barra
            let divFiles=doc.querySelector('.divFiles')
            divFiles.style.display='block'
            divFiles.innerHTML=ajax.responseText
        }
        ajax.send(formData)
    }
    if(doc.querySelector('#files')){

        let files=doc.querySelector('#files')
        files.addEventListener('change',upload,false)
    }

    let divFiles=doc.querySelector('.divFiles')

    divFiles.addEventListener('click', function(event){
        event.preventDefault()
        let element=event.target
        
        //Delete da images
        if(element.id === 'button-trash'){
            if(confirm('Deseja mesmo Apagar o Arquivo?')){
                
                let ajax=new XMLHttpRequest()
                ajax.open('GET', getRoot()+'controllers/controllerUpload/delete/'+element.dataset.fileid+'/'+element.dataset.filefk)
                ajax.onreadystatechange=function(){
                    divFiles.innerHTML= ajax.responseText
                }
                ajax.send()
            }else{
                return false;
            }
        }else{
            if(element.id === 'button-view'){
                win.open(element.dataset.src,'_blank')  //Abre uma nova guia com o caminho da images
            }
        }
    }, false)

    //Close page msg - alert
    let formSubmit=false
    
    function setFormSubmit(){ formSubmit=true }

    function exitPage(event){
        if(formSubmit){ return undefined }
        let confirmationMessage='Deseja Fechar ?'
        if((event || win.event).returnValue=confirmationMessage){
            let ajax=new XMLHttpRequest()
            ajax.open('GET',getRoot()+'controllers/controllerAds/closePage/'+doc.querySelector('#nextId').value)
            ajax.send()
        }
    }

    win.funcExitPage=exitPage
    
    if(doc.querySelector('form')){
        doc.querySelector('form').addEventListener('submit', setFormSubmit, false)
    }

})(window,document)