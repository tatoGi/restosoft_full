$('.add-video-card').on('click', function(e) {
    e.preventDefault();
    var parent = $(this).parent().children('.video-cards');
    $(this).parent().children('.hidden-video-card').clone().addClass('video-card').appendTo(parent);
})
$(document).on('click', '.remove-video-card', function(e) {
    e.preventDefault();
    $(this).parent().remove();
})

$("body").on("click", ".deletefile", function(){
    var elem = $(this).closest('.dfile');
    var que = $(this).data("id");
    var lang = $(this).data("lang");
    
    var TOKEN = $(this).data("token");
   if (confirm("დოკუმენტის წაშლა!?")) {
        $.ajax({
            url: $(this).data('route'),
            type: 'DELETE',
            data: {_token: TOKEN, que: que, lang:lang},
            dataType: 'JSON',
            success: function(response) {
                if(response.success){
                    elem.remove()
                }
            },
        });
       
        $(this).parents('.dfile').hide('slow');
    }
});


function myFunction() {
    var x = document.getElementsByClassName("inputparsley");
    console.log(x)
};
$(document).ready(function() {
    $(document).on('click', 'button[name="save"]', function() {
        var danj = $(".danger");
        for (var i = 0; i < danj.length; i++) {
            var cl3s = danj[i].classList;
            cl3s.remove("danger");
        }
    });
    $.listen('parsley:field:error', function(parsleyField) {
        var ewes = $("input[name='" + parsleyField.$element.attr('name') + "']").closest('.tab-pane').attr('id');
        var els = document.querySelectorAll("a[href='" + '#' + ewes + "']");
        for (var i = 0; i < els.length; i++) {
            var classes = els[i].classList;
            classes.add("danger");
        }
    });
    $("input").on("input", function() {
if ($(this).val().length > 0) {
    var ewes = $(this).closest('.tab-pane').attr('id');
    var els = document.querySelectorAll("a[href='" + '#' + ewes + "']");
    for (var i = 0; i < els.length; i++) {
        var classes = els[i].classList;
        classes.remove("danger");
    }
}
});
});



