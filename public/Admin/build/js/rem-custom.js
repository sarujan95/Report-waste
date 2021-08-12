var base_url = window.location.origin;
$(document).ready(function () {
    $('#create-service-form').submit(function (e) {
        var error_html =""
        var success_html = ""
        e.preventDefault()
        $.ajax({
            url: base_url+'/store-service',
            type: 'post',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
              success_html = '<div class="alert alert-success alert-dismissible " role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\
              </button>\
              <strong>Success!</strong> '+ response +'</div>'
              $('#status-notification').html(success_html);
              $('#status-notification').fadeIn('slow')
              setTimeout(function(){location.reload(true)}, 2000);
            },
            error:function(response){
                var data = response.responseJSON.errors
                for (var key in data) {
                   error_html += '<div class="alert alert-danger alert-dismissible " role="alert">\
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\
                   </button>\
                   <strong>'+key+'</strong> '+data[key]+'</div>';
                }
            $('#status-notification').html(error_html);
            $('#status-notification').fadeIn('slow').delay(20000).fadeOut('slow');
            }
        });
    });

    $('#create-service-selection-form').submit(function (e) {
        var error_html =""
        var success_html = ""
        e.preventDefault()
        $.ajax({
            url: base_url+'/store-service-selection',
            type: 'post',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
              success_html = '<div class="alert alert-success alert-dismissible " role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\
              </button>\
              <strong>Success!</strong> '+ response +'</div>'
              $('#status-notification').html(success_html);
              $('#status-notification').fadeIn('slow')
              setTimeout(function(){location.reload(true)}, 2000);
            },
            error:function(response){
                var data = response.responseJSON.errors
                for (var key in data) {
                   error_html += '<div class="alert alert-danger alert-dismissible " role="alert">\
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\
                   </button>\
                   <strong>'+key+'</strong> '+data[key]+'</div>';
                }
            $('#status-notification').html(error_html);
            $('#status-notification').fadeIn('slow').delay(20000).fadeOut('slow');
            }
        });
    });

    $('#create-service-package-form').submit(function (e) {
        var error_html =""
        var success_html = ""
        e.preventDefault()
        $.ajax({
            url: base_url+'/store-service-package',
            type: 'post',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
              success_html = '<div class="alert alert-success alert-dismissible " role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\
              </button>\
              <strong>Success!</strong> '+ response +'</div>'
              $('#status-notification').html(success_html);
              $('#status-notification').fadeIn('slow')
              setTimeout(function(){location.reload(true)}, 2000);
            },
            error:function(response){
                var data = response.responseJSON.errors
                for (var key in data) {
                   error_html += '<div class="alert alert-danger alert-dismissible " role="alert">\
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\
                   </button>\
                   <strong>'+key+'</strong> '+data[key]+'</div>';
                }
            $('#status-notification').html(error_html);
            $('#status-notification').fadeIn('slow').delay(20000).fadeOut('slow');
            }
        });
    });


    $('#create-recent-event-form').submit(function (e) {
        var error_html =""
        var success_html = ""
        e.preventDefault()
        $.ajax({
            url: base_url+'/store-recent-event',
            type: 'post',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
              success_html = '<div class="alert alert-success alert-dismissible " role="alert">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\
              </button>\
              <strong>Success!</strong> '+ response +'</div>'
              $('#status-notification').html(success_html);
              $('#status-notification').fadeIn('slow')
              setTimeout(function(){location.reload(true)}, 2000);
            },
            error:function(response){
                var data = response.responseJSON.errors
                for (var key in data) {
                   error_html += '<div class="alert alert-danger alert-dismissible " role="alert">\
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\
                   </button>\
                   <strong>'+key+'</strong> '+data[key]+'</div>';
                }
            $('#status-notification').html(error_html);
            $('#status-notification').fadeIn('slow').delay(20000).fadeOut('slow');
            }
        });
    });

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone", { 
       autoProcessQueue: false,
       acceptedFiles: ".jpeg,.jpg,.png,.gif"
    });

  

    $('#service-sample-upload').click(function(){

       myDropzone.processQueue();

    });
});

