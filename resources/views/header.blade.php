<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <button class="logout">Logout</button>

    <script>
        var token = localStorage.getItem('user_token');

        if (window.location.pathname == '/login' || window.location.pathname == '/register') {
            if (token != null) {
                window.open('/profile');
            }
            $(".logout").hide();
        } else {
            if (token == null) {
                window.open('/login', '_self');
            }
        }

        $(document).ready(function() {
            $(".logout").click(function() {
                $.ajax({
                    url: "http://127.0.0.1:8000/api/auth/logout",
                    type: "GET",
                    headers: {
                        'Authorization': localStorage.getItem('user_token')
                    },
                    success: function(data) {
                        if (data.success == true) {
                            localStorage.removeItem('user_token');
                            window.open("/login", "_self");
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
