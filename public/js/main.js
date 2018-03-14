// execute after the document is done loading
$(document).ready(function(){

    // ajax form handling to prevent double sends
    $("form[ajax=true]").children("input[type=submit]").click(function(){
        // get form node
        var form = $(this);
        while (!form.is("form")) {
            form = form.parent();
        }
        // get the url
        var url = form.attr("action");

        $.ajax({
            type: form.attr("method"),
            url: url,
            data: form.serialize(),
            success: function() {
                // maybe do some other stuff with data?
                
                // go to the location
                location.assign(url);  
            }
        });
        return false;
    });
});