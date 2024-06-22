$(document).ready(function(){

   setInterval(getdata,1000);

    $('.employee-id').click(function(e){
        e.preventDefault();

        id = $(this).data('eid');
        $('.dynamic-reciever-id').val(id);
        
        getdata();
        $('.chat-messages').animate({
            scrollTop: $('.chat-messages').prop('scrollHeight')
        }, 1000);

    });


    $('.message-send').submit(function(e){
        e.preventDefault();
        let id = $('.dynamic-reciever-id').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: base_url+'/employer/message/',
            data: $("form").serialize(),
            success: function(data){
                let response = data;
                if(response.is_success){
                    $('form').trigger('reset');
                    $('.chat-messages').animate({
                        scrollTop: $('.chat-messages').prop('scrollHeight')
                    }, 1000);
                }
            }
                
        });

    });

});

function getdata(){  

    let id = $('.dynamic-reciever-id').val();
    $.ajax({
        type: 'GET',
        url: current_url+'/'+id,
        success: function(data){
            let response = data;
            if(response.is_success){
                $('.chat').html(response.html);
                $('#employee-default').remove();
                $('#employer-default').remove();
                $('.employee-new').html(response.employee_html);
                $('.employer-new').html(response.employer_html);
                // $('#reciever_id').val(id);
            }
        }      
    });
    
    

    return false;



}