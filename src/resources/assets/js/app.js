$(function() {
    // Watch for type change
    $("#radio-whitelist, #radio-blacklist").change(function(radio) {
        $("#hint-whitelist, #hint-blacklist").toggleClass("d-none");
    });

    // Dynamic custom file input
    bsCustomFileInput.init();

    // Clipboard functionality
    new ClipboardJS(".clipboard-copy");
    
    // Watch for custom-file-label to change
    $(".custom-file-input").change(function(e) {
        var $input = $(e.target);
        if ($input.val() != "") {
            $input.siblings(".custom-file-label").removeClass("text-muted");
        } else {
            $input.siblings(".custom-file-label").addClass("text-muted");
        }
    });
});
