@include('header')

<body>



    <h1>Login</h1>

    <form id="login_form">
        @csrf
        <input type="email" name="email" placeholder="Enter email">
        <br>
        <span class="error email_err"></span>
        <br><br>
        <input type="password" name="password" placeholder="Enter password">
        <br>
        <span class="error password_err"></span>
        <br><br>
        <input type="submit" value="Login">
    </form>
    <br>
    <p class="result"></p>

    <a href="/forget-password">Forget Password</a>

    <script>
        $(document).ready(function() {
            $("#login_form").submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "http://127.0.0.1:8000/api/auth/login",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == false) {
                            $(".result").text(data.msg);
                        } else if (data.success == true) {
                            localStorage.setItem("user_token", data.token_type + "" + data
                                .access_token);
                            window.open("/profile", "_self");
                        } else {
                            printErrorMsg(data)
                        }
                    }
                });
            });

            function printErrorMsg(msg) {
                $(".error").text("");
                $.each(msg, function(key, value) {
                    $("." + key + "_err").text(value);
                });
            }
        });
    </script>
</body>
