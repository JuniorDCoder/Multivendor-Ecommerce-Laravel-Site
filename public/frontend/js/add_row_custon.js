$(function () {
    
    "use strict";

    // for single input
    
    $("#add_row").on('click',function () {
        var html = '';
        html+='<div  id="remove">';
        html+='<label for="">Name</label>';
        html+='<div class="medicine_row_input">';

        html+='<input type="text" name="name[]">';
        html+='<button type="button" id="removeRow" ><i class="fas fa-trash" aria-hidden="true"></i></button>';
        html+='</div>';
        html+='</div>';
        $("#medicine_row").append(html)
    });

    // remove custom video input field row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#remove').remove();
    });

    
    
  // for 2 input in 1 row

  $("#add_row3").on('click',function () {
    var html = '';
    html+='<div class="row" id="remove">';
    html+='<div class="col-xl-5 col-md-5">';
    html+='<div class="medicine_row_input">';
    html+='<input type="text" placeholder="www.facebook.com" name="name[]" id="name">';
    html+='</div>';
    html+='</div>';
    html+='<div class="col-xl-5 col-md-5">';
    html+='<div class="medicine_row_input">';
    html+='<input type="text" placeholder="www.youtube.com" name="name[]" id="name">';
    html+='</div>';
    html+='</div>';
    html+='<div class="col-xl-2 col-md-2">';
    html+='<div class="medicine_row_input">';
    html+='<button type="button" id="removeRow" ><i class="fas fa-trash" aria-hidden="true"></i></button>';
    html+=' </div>';
    html+=' </div>';
    html+='</div>';
    $("#medicine_row3").append(html)
  });

  // remove custom input field row
  $(document).on('click', '#removeRow', function () {
    $(this).closest('#remove').remove();
  });

    
});
