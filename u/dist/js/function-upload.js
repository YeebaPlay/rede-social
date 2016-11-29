var $a = jQuery.noConflict();
$a(document).ready(function() { 

    var progressbox     = $a('#progressbox');
    var progressbar     = $a('#progressbar');
    var statustxt       = $a('#statustxt');
    var completed       = '0%';
    
    var options = { 
            target:   '#output',   // target element(s) to be updated with server response 
            beforeSubmit:  beforeSubmit,  // pre-submit callback 
            uploadProgress: OnProgress,
            success:       afterSuccess,  // post-submit callback 
            resetForm: true        // reset the form after successful submit 
        }; 
        
     $a('#MyUploadForm').submit(function() { 
            $a(this).ajaxSubmit(options);            
            // return false to prevent standard browser submit and page navigation 
            return false; 
        });
    
//when upload progresses    
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
    progressbar.width(percentComplete + '%') //update progressbar percent complete
    statustxt.html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            statustxt.css('color','#fff'); //change status text to white after 50%
        }
}

//after succesful upload
function afterSuccess()
{
    $a('#submit-btn').show(); //hide submit button
    $a('#loading-img').hide(); //hide submit button
    $a('#notificacao_sucesso').show();

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
    {

        if( !$a('#imageInput').val()) //check empty input filed
        {
            $a("#output").html("Voc&ecirc; est&aacute; brincando comigo? [Selecione o arquivo]");
            return false
        }
        
        var fsize = $a('#imageInput')[0].files[0].size; //get file size
        var ftype = $a('#imageInput')[0].files[0].type; // get file type
        
        //allow only valid image file types 
        switch(ftype)
        {
            case 'application/pdf' : 
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : 
            case 'text/plain' :
            case 'application/msword' :
            case 'binary/octet-stream' :
               break;
            default:
                $a("#output").html("<b>"+ftype+"</b> Tipo de arquivo n&atilde;o suportado!");
                return false
        }
        
        //Allowed file size is less than 50 MB (209715200)
        if(fsize > 8388608)
        {
            $a("#output").html("<b>"+bytesToSize(fsize) +"</b> O arquivo &eacute; muito grande.");
            return false
        }
        
        //Progress bar
        progressbox.show(); //show progressbar
        progressbar.width(completed); //initial value 0% of progressbar
        statustxt.html(completed); //set status text
        statustxt.css('color','#000'); //initial color of status text

                
        $a('#submit-btn').hide(); //hide submit button
        $a('#loading-img').show(); //hide submit button
        $a("#output").html("");  
    }
    else
    {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $a("#output").html("Por favor, atualize seu navegador, porque o seu navegador atual carece de algumas novas funcionalidades que precisamos!");
        return false;
    }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 
