const baseurl = $('#base-url').data('url');

$('.star-rating .fa').on('click', function () {
    let ratingDiv = $(this).parent()
    let ratingId = ratingDiv.data('id')
    
  $(this).siblings('input.rating-value').val($(this).data('rating'));
    ratingDiv.children('.star-rating .fa').each(function () {
    if (parseInt($(this).siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  })
});

$(document).on('click', '.addToCart', function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    
    toggleAddToCart(id);
})

$(document).on('click', '.cancelAddToCart', function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    
    toggleAddToCart(id);
})

$(document).on('click', '.authFormToggle', function (e) {
    e.preventDefault();
    
    $('#loginForm').toggle()
    $('#registerForm').toggle()
    $('#loginModalLabel').toggle()
    $('#registerModalLabel').toggle()
})


$(document).on('click', '#registerButton', function(e) {
    e.preventDefault();
    var $this = $(this);
    $this.html(`<div class="spinner-border spinner-border-sm" role="status">
    <span class="sr-only">Loading...</span>
  </div>`)
    let myform = $('form#registerForm');

    let data = myform.serialize();
    let url = myform.attr('action');
    var form = document.getElementById("registerForm")
    // var myform = form;

    var fd = new FormData(form);
    $.ajax({
        url: url,
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        type: 'POST',
        success: function (response) {
            console.log(response)
            // var data = response.responseJSON
            var data = response
            if (data.status == 201)
            {
                successNoty(data.message)
                window.location = baseurl;
            }
            else
            {
                errorNoty(data.message)
            }
        },
        error: function (response) {
            var data = response.responseJSON
            errorNoty(data.message)
        },
        complete: function () {
            $('#registerButton').html('Register')
        }
            
    });

});

$(document).on('click', '#loginButton', function(e) {
    e.preventDefault();

    var $this = $(this);
    $this.html(`<div class="spinner-border spinner-border-sm" role="status">
    <span class="sr-only">Loading...</span>
  </div>`)
    let myform = $('form#loginForm');

    let data = myform.serialize();
    let url = myform.attr('action');
    var form = document.getElementById("loginForm")
    // var myform = form;

    var fd = new FormData(form);
    $.ajax({
        url: url,
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        type: 'POST',
        success: function (response) {
            console.log(response)
            
            // var data = response.responseJSON
            var data = response
            if (data.status == 201)
            {
                successNoty(data.message)
                window.location = baseurl;
            }
            else
            {
                errorNoty(data.message)
            }
        },
        error: function (response) {
            
            var data = response.responseJSON
            errorNoty(data.message)
        },
        complete: function (response) {
            // alert('here');
            $("#loginButton").html('Log in')
        }
            
    });

});

$(document).on('click', '.sendToCart', function (e) {
    
    e.preventDefault();
    var $this = $(this);
    
    $this.html(`<div class="spinner-border spinner-border-sm" role="status">
    <span class="sr-only">Loading...</span>
  </div>`)

    let id = $this.data('id');
    
    let myform = $(`form#quantityForm${id}`);

    let data = myform.serialize();
    let url = myform.attr('action');
    var form = document.getElementById(`quantityForm${id}`)
    // var myform = form;

    var fd = new FormData(form);
    $.ajax({
        url: url,
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        type: 'POST',
        success: function (response) {
            console.log(response)
            
            // var data = response.responseJSON
            var data = response
            successNoty(data.message)
        },
        error: function (response) {
            
            var data = response.responseJSON
            errorNoty(data.message)
        },
        complete: function (response) {
            $this.html('Add')
            toggleAddToCart(id);
        }
            
    });

});

$(document).on('click', '.star-rating', function(e) {
    
    let $this = $(this)
    let id = $(this).data('id');
    let url = $(this).data('url');
    let csrf = $(this).data('csrf');
    let rating = $(`#rating${id}`).val();

    let formData = {
        "value" : rating,
        "product_id" : id,
        "csrf_token" : csrf,
        "url" : url
    };

    $.ajax({
        url: url,
        data: formData,
        dataType: "json",
        type: 'POST',
        success: function (response) {
            console.log(response)
            
            // var data = response.responseJSON
            var data = response
            successNoty(data.message)
        },
        error: function (response) {
            
            var data = response.responseJSON
            errorNoty(data.message)

            $('.star-rating .fa').each(function() {
                  return $(this).removeClass('fa-star').addClass('fa-star-o');
            })
        },
        complete: function (response) {
            
        }
            
    });

});

$("select[name=shipping_option]").change(function () {
    if ($(this).val() == 'ups')
    {
        $('#upsFee').show();
    }
    else
    {
        $('#upsFee').hide();
    }
});

$(document).on('click', '.removeCart', function(e) {
    
    let id = $(this).data('id');
    let url = $(this).data('url');
    let csrf = $(this).data('csrf');

    let formData = {
        "id" : id,
        "csrf_token" : csrf
    };
    

    $.ajax({
        url: url,
        data: formData,
        dataType: "json",
        type: 'POST',
        success: function (response) {
            console.log(response)
            
            // var data = response.responseJSON
            var data = response
            successNoty(data.message)
            $(`#cart${id}`).hide()
            $("#orderDetail").load(location.href + " #orderDetail");
        },
        error: function (response) {
            
            var data = response.responseJSON
            errorNoty(data.message)
        },
        complete: function (response) {
            // alert('here');
        }
            
    });

});


$(document).on('click', '#checkoutButton', function(e) {
    e.preventDefault();

    var $this = $(this);
    $this.html(`<div class="spinner-border spinner-border-sm" role="status">
    <span class="sr-only">Loading...</span>
  </div>`)
    let myform = $('form#checkoutForm');
    let url = myform.attr('action');
    var form = document.getElementById("checkoutForm")
    // var myform = form;

    var fd = new FormData(form);
    $.ajax({
        url: url,
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        type: 'POST',
        success: function (response) {
            console.log(response)
            
            // var data = response.responseJSON
            var data = response
            successNoty(data.message)
            window.location = baseurl;
        },
        error: function (response) {
            
            var data = response.responseJSON
            errorNoty(data.message)
        },
        complete: function (response) {
            $this.html('Checkout')
        }
            
    });

});

$(document).ready(function() {

});

function toggleAddToCart(id)
{
    $(`#quantityForm${id}`).toggle()
    $(`#addToCartButton${id}`).toggle()
}

function successNoty(message)
{
    toastr.success(message)
}

function errorNoty(message)
{
    toastr.error(message)

}
