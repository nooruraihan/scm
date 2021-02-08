<footer class="bg-light text-center text-lg-start">

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2020 Copyright:
    <a class="text-dark" href="">test.com</a>
  </div>

</footer>
<script>
 	   function registersubmit() {

        var formElem = $("#registration");
        var formdata = new FormData(formElem[0]);
        $.ajax({

                url: "<?php echo base_url('user/submitregister') ?>",
                method: "POST",
                data: formdata, 
                contentType: false, 
                cache: false, 
                processData: false,                          
                success: function (response) {

        if ($.trim(response) === 'success') {
            $('form').trigger('reset');
            $('#sucesssubmitreg').show().html('You are registered successfully.');
            setTimeout(function () {
                $('#sucesssubmitreg').hide(
             window.location.replace("<?php echo base_url('user/login') ?>")
            );
            }, 3000);
        } else if ($.trim(response) === 'fail') {
            $('#failsubmitreg').show().html('Something error please try again');
            setTimeout(function () {
                $('#failsubmitreg').hide();
            }, 3000);
        } else if ($.trim(response) === 'notvalid') {
//                                    
            $('#failsubmitreg').show().html('Please validate all field');
            setTimeout(function () {
                $('#failsubmitreg').hide();
            }, 3000);
        } else if ($.trim(response) === 'passnot') {
//                                    
            $('#failsubmitreg').show().html('Password does not match');
            setTimeout(function () {
                $('#failsubmitreg').hide();
            }, 3000);
        } else if ($.trim(response) === 'emailalready') {
            $('#failsubmitreg').show().html('Email already exist');
            setTimeout(function () {
                $('#failsubmitreg').hide();
            }, 3000);
        }
    }
});
return false;
}
$(document).ready(function () {
    $(".imagevalidationone").on('change', function () {
        var img = $('.imagevalidationone').val();
       
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {

        } else {
            alert('Your image was not .gif, .jpg, .png, .jpeg');
            $('.imagevalidationone').val(''); 
        }
    });
});

</script>
<script>
        function loginsubmit() {
                        
                        $.ajax({

                            url: "<?php echo base_url('user/loginsubmit') ?>" ,
                            method: "POST",
                            data: $('#loginform').serialize(),
//                         
                            success: function (response) {
//                               alert(response);
                                if ($.trim(response) === 'success') {
                                    window.location.href = "<?php echo base_url('user')?>";
                                } else if ($.trim(response) === 'fail') {
                                     $('#failsubmit').show().html();
                                    setTimeout(function () {
                                        $('#failsubmit').hide();
                                    }, 3000);
                                }
                            }
                        });
                        return false;
                    }
    </script>
</body>
</html>