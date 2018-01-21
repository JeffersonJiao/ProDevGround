$(document).ready(()=>{
    $("#showMember").click(()=>{
        $("#membersTable").toggleClass("show");
    });
    
    $('.form-delete').on('click', function(e){
        e.preventDefault();
        
        var $form=$(this);
        $('#confirm').show({done:()=>{
            $(document).on('click','.modal button',(e)=>{
                $result = e.target.value;
                if($result == 0){
                    $("#confirm").hide();
                    return false;
                }
                else if($result ==1){
                    $("#confirm").hide();
                    $($form).submit();
                }
            });
            
        }});
        
    });
    
    
});