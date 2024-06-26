$(document).ready(function(){



    setInterval(getdata,1000);

   $('.search').on('input', function(e){
    e.preventDefault();
    let key = $('.search').val();
    
    if (key.length > 0){

      
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url:current_url+'/search',
        data:{'key':key},
        success:function (data){
            let response = data;
            
            response.user.forEach(users => {
                users.forEach(user => {

                   $('#searchResults').html(`
                                       <a  href="" data-eid="${user.id}"
                                        class="list-group-item list-group-item-action border-0 employee-id">
                                        <div class="d-flex align-items-start">
                                            <img src="${base_url}/storage/upload/user/${user.image}"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40"
                                                height="40">
                                            <div class="flex-grow-1 ml-3">
                                                 ${user.name} 
                                                <div class="small"><span class="fas fa-circle chat-online"></span> Online
                                                </div>
                                            </div>
                                        </div>
                                    </a>`);
                                });
                            });
                        }
                    });
                    $('#searchResults').show();
                    $('.all-employee').hide();
                } else {
                    $('#searchResults').hide(); 
                    $ ('.all-employee').show()

                }
            });    

    $(document).on('click','.employee-id',function(e){
   
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

    
