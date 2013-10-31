$(document).ready(function(){
    $('#rol').click(function(){
     $.ajax({ 
      type: 'POST',
      url: 'admin/rol',
      success: function(data) { $('#marco').html(data); },
      error: function(data){ jAlert("Error al realizar proceso."); }
     });
    });
    
    jQuery.fn.reset = function () { $(this).each (function() { this.reset(); }); }
   });
