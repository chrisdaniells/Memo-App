// Bind to the resize event of the window object
$(window).on("resize", function () {
    $("main").css('height', $(window).height() - 35);
    $("previews").css('height', $(window).height() - 85);
}).resize();

$(document).ready( function() {
  document.createElement('previews');
  document.createElement('pr');
  document.createElement('articlestrip');

  $('#new-memo').click( function() {
    $('#new-memo-form').css('display', 'block');
    $('#right-column').css('display', 'block');
  });
  $('#new-memo-form-close').click( function() {
    $('#new-memo-form').css('display', 'none');
    $('form[name="new-memo"]').find("input[type=text], textarea, input[type=date]").val("");
    $('#new-memo-urgency').prop('selectedIndex',0);
    $('#new-memo-title, #new-memo-description, #new-memo-deadline, #new-memo-urgency').removeClass('form-field-error');

    if ($(window).width() < 981) {
        $('#right-column').css('display', 'none');
    }
  });
});

$(document).ready(function() {
    $('nav ul li').click(function() {
        var previewDisplayName = $(this).data('preview-display');
        $('previews').hide();
        $('previews.' + previewDisplayName).show();
    });

    $('previews pr').click(function() {
        $('previews pr').removeClass('active');
        $(this).addClass('active');

        var currID = $(this).data('id');

        $('previews pr').each(function() {
            if ($(this).data('id') == currID) {
                $(this).addClass('active');
            }
        });

        $.ajax({
            type: "GET",
            url: "ajax/memo.ajax.php?id=" + currID,
            dataType: "html",
            success: function(response){
                $("#article-holder").html(response);
                $('#done').attr('data-done', currID);
            }
        });
        $('#right-column').css('display', 'block');
    });

    $('form[name="new-memo"]').submit(function(event) {
        event.preventDefault();
        // Validation
        var errCount = 0;
        if (!$('#new-memo-title').val() || $('#new-memo-title').val().length > 200) {
            $('#new-memo-title').addClass('form-field-error');
            errCount++;
        }
        if (!$('#new-memo-description').val()) {
            $('#new-memo-description').addClass('form-field-error');
            errCount++;
        }
        if (!$('#new-memo-deadline').val()) {
            $('#new-memo-deadline').addClass('form-field-error');
            errCount++;
        }
        if ($('#new-memo-urgency').val() == "") {
            $('#new-memo-urgency').addClass('form-field-error');
            errCount++;
        }

        // Form Submit
        if (errCount == 0) {
            $.ajax({
                type: "POST",
                url: $('form[name="new-memo"]').attr('action'),
                data: $('form[name="new-memo"]').serialize(),
                success: function(response){
                    window.location.replace("index.php?message=memo-added");
                }
            });
            if ($(window).width() < 981) {
                $('#right-column').css('display', 'none');
            }
        }
    });
    $('#new-memo-title, #new-memo-description, #new-memo-deadline').keyup(function(event) {
        $(this).removeClass('form-field-error');
    });
    $('#new-memo-urgency').change(function() {
        $(this).removeClass('form-field-error');
    });
});

$(document).ajaxComplete(function() {
    $('#done').click(function() {
        var currID = $(this).data('done');
        $.ajax({
            type: "GET",
            url: "ajax/deletememo.ajax.php?id=" + currID,
            dataType: "html",
            success: function(response){
                $("articlestrip").html(response);
                window.location.replace("index.php?message=memo-deleted");
            }
        });
    });
});
