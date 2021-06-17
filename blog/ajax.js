$(document).ready(function(){
    var files;
    $('#postfile').on('change', function(){
        files = this.files;
    })
    $('#public').click(function(e){
        e.preventDefault();
        console.log($('.blogMain'));
        var text = $('#text').val();
        var data = new FormData();
        $.each(files, function( key, value){
            data.append( key, value);
        })
        data.append('my_file_upload', 1)
        data.append('text', text);

        jQuery.ajax({
            type: "POST",
            url: "serv.php",
            dataType: "text",
            data: data,
            processData: false,
            contentType: false,
            success:function(html){
                $('.blogMain').prepend(html);
                $('.noMessage')[0].style.display = "none";
                console.log("true");
            }
        })
    })
})