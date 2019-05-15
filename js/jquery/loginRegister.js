$(document).ready(function(){
    $(document).on('click', '#logRegButton', function(){
        var html = `
            <div class="float-left">
                <form id='sign_up_form'">
                    <h2>Sign Up</h2>
                    <div class="form-group">
                        <label for="firstname">username</label>
                        <input type="text" class="form-control" name="username" id="username" required />
                    </div>
    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required />
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" required />
                    </div>
    
                    <button type='submit' onsubmit="return false" class='btn btn-primary'>Sign Up</button>
                </form>
            </div>
            <div class="float-right">
                <form id='login_form'">
                    <h2>Login</h2>
                    <div class='form-group'>
                        <label for='username'>username</label>
                        <input type='text' class='form-control' id='username' name='username' placeholder='Enter username'>
                    </div>
        
                    <div class='form-group'>
                        <label for='password'>Password</label>
                        <input type='password' class='form-control' id='password' name='password' placeholder='Password'>
                    </div>
        
                    <button type='submit' onsubmit="return false" class='btn btn-primary'>Login</button>
                </form>
            </div>
            `;
        clearResponse();
        $('#home').html(html);
    });

    $(document).on('submit', '#sign_up_form', function(){
        var sign_up_form=$(this);
        var form_data=JSON.stringify(sign_up_form.serializeObject());
        $.ajax({
            url: "api/user/create_user.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                $('#response').html("<div class='alert alert-success'>Successful sign up. you are now logged in.</div>");
                sign_up_form.find('input').val('');
            },
            error: function(xhr, resp, text){
                $('#response').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
            }
        });
        return false;
    });

    $(document).on('submit', '#login_form', function(){
        var login_form=$(this);
        var form_data=JSON.stringify(login_form.serializeObject());
        $.ajax({
            url: "api/user/login.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : async function(result){
                setCookie("jwt", result.jwt, 1);
                $('#response').html("<div class='alert alert-success'>Successful login.</div>");
                var userid = await getUserId();
                var cartcheck = await $.post("http://192.168.33.10/api/order/create_cart.php", JSON.stringify({userid: userid})).done(function(result) {});
            },
            error: function(xhr, resp, text){
                $('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
                login_form.find('input').val('');
            }
        });
        return false;
    });

    function clearResponse(){
        $('#response').html('');
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function showLoggedOutMenu(){
        $("#login, #sign_up").show();
        $("#logout").hide();
    }

    $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    }
});
