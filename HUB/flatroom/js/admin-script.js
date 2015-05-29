function addFlatroomOption(){
    jQuery(document).ready(function($){
        var type = $("#option-type-select").val();
        var name = $("#option-name").val();
        var str = name.replace(/[^a-zA-Z_0-9-]/g, '-') + '-' + type;

        if (!$('.' + str).length && (name != '')) {
            var preview_l = document.createElement('li');
            preview_l.className = str + ' widget ui-draggable';

            var hidden_type = '<input type="hidden" value="' + type + '" class="hidden-option-type">';
            var hidden_name = '<input type="hidden" value="' + name + '" class="hidden-option-name">';
            var hidden_class = '<input type="hidden" value="' + str + '" class="hidden-option-class">';
            var button = '<input type="button" class="btn" value="Remove" onClick="removeFlatroomOption(\'' + str + '\');">';
            var text = '<span>' + name + ' (' + $("#option-type-select :selected").text() + ')</span>';

            preview_l.innerHTML = hidden_type + hidden_name + hidden_class + text + button;
        
            var preview = document.getElementById("selected-options-preview");
            preview.appendChild(preview_l);
            getOptionsJson();
        }
    });
};
function removeFlatroomOption(item) {
    jQuery(document).ready(function($){
        $('li.' + item).remove();
        getOptionsJson();
    });
}
function getOptionsJson(){
    jQuery(document).ready(function($){
        var jsonElement = document.getElementById("selected-options");
        var json = [];
        $( "#selected-options-preview li" ).each(function() {
            var type = $(this).find('.hidden-option-type').val();
            var name = $(this).find('.hidden-option-name').val();
            var class_name = $(this).find('.hidden-option-class').val();
            if ((name != '') && (type != '') && (class_name != '')) {
                if (json) {
                    json.push( {"name":name,"type":type,"class_name":class_name} );
                }
                else {
                    json = [{"name":name,"type":type,"class_name":class_name}];
                }
            }
        });
        jsonElement.value = JSON.stringify(json);
    });
};

(function($){
    $(document).ready(function() {
        
        /******************************************************************************
            Header Social Icon
        *******************************************************************************/
        $('.social_preview').sortable({
            placeholder: "ui-state-highlight",
            beforeStop: function( event, item ) {
                var value = '';
                $('.social_preview li').not('.ui-state-highlight').each(function() {
                    value += '[social type_icon=' + $('i', this).attr('class').replace('icon-', '') + ' href=' + $('a', this).attr('href') + ']';
                });
                $('#social_header_input').val(value);
            }
        });
        
        $(".social_preview").on('click', ".social_remove", function () {
            $("#social_header_input").val($("#social_header_input").val().replace(new RegExp('\\[[^\\]]+type_icon=' + $(this).closest("li").remove().find("i").attr('class').replace('icon-', '') + '[^\\]]+\\]', 'gi'), ''));
            return false;
        });

        $(".social_preview li").each(function() {
            $('<a href="#" class="social_remove button-secondary">Remove</a>').appendTo($(this));
        });

        $("#social_add").click(function() {
            if ($('.social_preview li a i').is(".icon-" + $(".social").val())) {
                alert("Such a social network is already added");
                return false;
            } else {
                $('<li><a href="' + $('.social_link').val() + '"><i class="icon-' + $(".social").val() + '"></i></a><a href="#" class="social_remove button-secondary">Remove</a></li>').appendTo($(".social_preview"));
                $("#social_header_input").val($("#social_header_input").val() + '[social type_icon=' + $(".social").val() + ' href=' + $('.social_link').val() + ']');
            }
            return false;
        });
        
        /******************************************************************************
            Social Icon
        *******************************************************************************/
        $(".dropdown dt").click(function() {
            $(".dropdown dd ul").toggle();
        });
        
        $(".dropdown dd ul li").click(function() {
            var text = $(this).html();
            $(".dropdown dt span").html(text);
            $(".dropdown dd ul").hide();
            $(".features-icon-selected").val($(this).find('i').attr("class"));
        });
    
        if ($(".features-icon-selected").length) {
            var default_icon = $(".features-icon-selected").val().replace('fa ', '');
            if (default_icon != '') {
                var text = $('i.' + default_icon).parents('li').html();
                $(".dropdown dt span").html(text);
            }
        }
        
        /******************************************************************************
            Pricing Options
        *******************************************************************************/
        $( "#selected-options-preview" ).sortable({
            beforeStop: function( event, ui ) {
                getOptionsJson();
            }
        });
        $( "#selected-options-preview" ).disableSelection();
    
        $( "#selected-social-icons-preview" ).sortable({
            beforeStop: function( event, ui ) {
                getSocialJson();
            }
        });
        $( "#selected-social-icons-preview" ).disableSelection();
    
        $(".dropdown dd ul li").click(function() {
            var text = $(this).html();
            $(".dropdown dt span").html(text);
            $(".dropdown dd ul").hide();
            $(".pricing-icon-selected").val($(this).find('i').attr("class"));
        });
    
        var default_icon = $(".pricing-icon-selected").val();
        if (default_icon != '') {
            var text = $('i.' + default_icon).parent().html();
            $(".dropdown dt span").html(text);
        }

        $('#social-icons-preview').sortable({
            'beforeStop': function( event, ui ) {
                socialIconsJson();
            }
        });
        
        $('.remove-social-icon').live('click', function (e) {
        
            e.preventDefault();
          
            $(this).parent().remove();
            socialIconsJson();
        });
        
        $('.add-social-icon').live('click', function (e) {
        
            e.preventDefault();
          
            var icon = $('#social-icons-select option:selected').val();
            var url  = $('#social-icons-url').val();
          
            if (!$('input[value=' + icon + ']').length && (url != '')) {
          
                var hidden_icon = '<input type="hidden" value="' + icon + '" class="hidden-option-icon">';
                var hidden_url  = '<input type="hidden" value="' + url + '" class="hidden-option-url">';
                var button      = '<a href="#" class="remove-social-icon">' + ibr.remove + '</a>';
                var preview     = '<li class="widget ui-sortable">' + hidden_icon + hidden_url + '<i class="icon-' + icon + '"></i>' + button + '</li>';
            
                $('#social-icons-preview').append(preview);
                socialIconsJson();
            }
        });
    });
})(jQuery);

function socialIconsJson() {

  var $ = jQuery;
  var json = [];

  $( "#social-icons-preview li" ).each(function() {
    var icon = $(this).find('.hidden-option-icon').val();
    var url = $(this).find('.hidden-option-url').val();
    if ((url != '') && (icon != '')) {
      if (json) {
        json.push( {"icon":icon,"url":url} );
      }
      else {
        json = [{"icon":icon,"url":url}];
      }
    }
  });
  $('#selected-social-icons').val(JSON.stringify(json));
};