$(document).ready(function(){

$("#multiple").select2({
    placeholder: "Select a  language",
    allowClear: true
});

$("#skills").select2({
    placeholder: "Choose Skills",
    allowClear: true
});

$('#bell-icon').click(function(e){
    e.preventDefault();
$('.notification-modal').modal('show');
$.ajax({
    type: "GET",
    url: base_url + '/notification',
    success: function(data){
        let response = data;
        jQuery(".icon-button__badge").hide();
        if(response.is_success){
            jQuery('.notification-list').html(response.html);
            
        }
    }
});
});

$('.review').click(function(e){
    e.preventDefault();
    $('#review-modal').modal('show');
    let job_id  = $(this).data('jobid');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url: base_url + '/review',
        data: {'job_id':job_id},

        success: function(data){
            let response = data;
            if(response.is_success){
                jQuery('.review-details').html(response.html);
            }
        }
    });
});
});

