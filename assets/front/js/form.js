$(document).ready(function() {
    $("#inquiry").submit(function(t) {
        t.preventDefault();
        var e = $("#button");
        e.button("loading"), $("#button").attr("disabled", !0), $("#inquiry").serialize(), $.ajax({
            url: "mail.php",
            type: "POST",
            data: new FormData(this),
            mimeType: "multipart/form-data",
            contentType: !1,
            cache: !1,
            processData: !1,
            success: function(t) {
                console.log(t), "true" == t ? (alert("Thank You For Submit Inquiry"), window.location.href = "index.php") : ($(".error_1").text(t), e.button("reset"))
            }
        })
    })

});