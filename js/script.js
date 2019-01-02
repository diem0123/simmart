/**/
$(document).ready(function(){
	/*name */
	$('#name').blur(function(){
		var name = $('#name').val();
		if(name == ''){
			$('#name').next('.error').text('Không được bỏ trống');
			return false;
		}else{
			$('#name').next('.error').text('');
		}
	});
	/* phone*/
	$('#phone').blur(function(){
		var phone = $('#phone').val();
		if(phone == ''){
			$('#phone').next('.error').text('Không được bỏ trống');
			return false;
		}else{
			$('#phone').next('.error').text('');
		}

		if(validatephone(phone)){
            // hidden class error
            $('#phone').next('.error').text('');
            $('#phone').next('.error').fadeOut(500);
        }else{ // return false  
            $('#phone').next('.error').text('Số điện thoại không đúng');
            $('#phone').next('.error').fadeIn(500);
            return false;
        }
        // hàm này kiểm tra số điện thoại
        function validatephone(phone) {
            var filter = /^[0-9-+]+$/;
            if (filter.test(phone)) {
                return true;
            }
            else {
                return false;
            }
        }
	});

	/*cmnd*/
	$('#cmnd').blur(function(){
		var cmnd = $('#cmnd').val();
		if(cmnd == ''){
			$('#cmnd').next('.error').text('Không được bỏ trống');
			return false;
		}else{
			$('#cmnd').next('.error').text('');
		}

		if(validatephone(cmnd)){
            // hidden class error
            $('#cmnd').next('.error').text('');
            $('#cmnd').next('.error').fadeOut(500);
        }else{ // return false  
            $('#cmnd').next('.error').text('Sai định dạng');
            $('#cmnd').next('.error').fadeIn(500);
            return false;
        }
        // hàm này kiểm tra số điện thoại
        function validatephone(cmnd) {
            var filter = /^[0-9-+]+$/;
            if (filter.test(cmnd)) {
                return true;
            }
            else {
                return false;
            }
        }
	});

	/*diachi*/
	$('#diachi').blur(function(){
		var diachi = $('#diachi').val();
		if(diachi == ''){
			$('#diachi').next('.error').text('Không được bỏ trống');
			return false;
		}else{
			$('#diachi').next('.error').text('');
		}
	});
	$('#submit_phone').click(function(){
		var name = $('#name').val();
		if(name == ''){
			$('#name').next('.error').text('Không được bỏ trống');
			return false;
		}else{
			$('#name').next('.error').text('');
		}
		/*phone*/
		var phone = $('#phone').val();
		if(phone == ''){
			$('#phone').next('.error').text('Không được bỏ trống');
			return false;
		}else{
			$('#phone').next('.error').text('');
		}

		if(validatephone(phone)){
            // hidden class error
            $('#phone').next('.error').text('');
            $('#phone').next('.error').fadeOut(500);
        }else{ // return false  
            $('#phone').next('.error').text('Số điện thoại không đúng');
            $('#phone').next('.error').fadeIn(500);
            return false;
        }
        // hàm này kiểm tra số điện thoại
        function validatephone(phone) {
            var filter = /^[0-9-+]+$/;
            if (filter.test(phone)) {
                return true;
            }
            else {
                return false;
            }
        }
        var cmnd = $('#cmnd').val();
		if(cmnd == ''){
			$('#cmnd').next('.error').text('Không được bỏ trống');
			return false;
		}else{
			$('#cmnd').next('.error').text('');
		}

		if(validatephone(cmnd)){
            // hidden class error
            $('#cmnd').next('.error').text('');
            $('#cmnd').next('.error').fadeOut(500);
        }else{ // return false  
            $('#cmnd').next('.error').text('Sai định dạng');
            $('#cmnd').next('.error').fadeIn(500);
            return false;
        }
        // hàm này kiểm tra số điện thoại
        function validatephone(cmnd) {
            var filter = /^[0-9-+]+$/;
            if (filter.test(cmnd)) {
                return true;
            }
            else {
                return false;
            }
        }
        var diachi = $('#diachi').val();
		if(diachi == ''){
			$('#diachi').next('.error').text('Không được bỏ trống');
			return false;
		}else{
			$('#diachi').next('.error').text('');
		}
	});

    $('#back').click(function(){
        history.back();
    });
});