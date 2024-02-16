@include('header')

<h1>HI, <span class="name"></span></h1>

<div class="email_verify">
    <p><b>Email :- <span class="email"></span> &nbsp; <span class="verify"></span></b></p>
</div>

<form action="" id="profileForm">
    <input type="" value="" name="id" id="user_id">
    <input type="text" name="name" placeholder="Enter name" id="name">
    <br>
    <span class="error name_err" style="color:red"></span>
    <br><br>
    <input type="email" name="email" placeholder="Enter email" id="email">
    <br>
    <span class="error email_err" style="color:red"></span>
    <br><br>
    <input type="submit" value="updateProfile">
</form>

<div class="result" style="color:green;"></div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "http://127.0.0.1:8000/api/auth/profile",
            type: "GET",
            headers: {
                'Authorization': localStorage.getItem('user_token')
            },
            success: function(data) {
                if (data.success == true) {

                    $(".name").text(data.data.name);
                    $(".email").text(data.data.email);
                    $("#user_id").val(data.data.id);
                    $("#name").val(data.data.name);
                    $("#email").val(data.data.email);

                    if (data.data.is_verified == 0) {
                        $(".verify").html("<button class='verify_mail' data-id='" + data.data
                            .email + "'>Verify</button>")
                    } else {
                        $(".verify").text("Verified");
                    }

                } else {
                    alert(data.msg);
                }
            }
        });

        $("#profileForm").submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "http://127.0.0.1:8000/api/auth/update-profile",
                type: "POST",
                data: formData,
                headers: {
                    'Authorization': localStorage.getItem('user_token')
                },
                success: function(data) {
                    if (data.success == true) {
                        $(".error").text("");
                        setTimeout(() => {
                            $(".result").text("");
                            location.reload();
                        }, 200);


                        if (data.data.is_verified == 0) {
                            $(".verify").html("<button class='verify_mail' data-id='" + data
                                .data.email + "'>Verify</button>");
                        }

                        $(".verify").val("verify_mail");
                    } else {
                        printErrMsg(data);
                    }
                }
            });
        });

        function printErrMsg(msg) {
            $(".error").text("");
            $.each(msg, function(key, value) {
                $("." + key + "_err").text(value);
            });
        }

        $(document).on('click', '.verify_mail', function() {
            var email = $(this).attr('data-id');
            $.ajax({
                url: "http://127.0.0.1:8000/api/auth/send-verify-mail/" + email,
                type: "GET",
                headers: {
                    'Authorization': localStorage.getItem('user_token')
                },
                success: function(data) {
                    $('.result').text(data.msg);
                    setTimeout(() => {
                        $('.result').text("");

                    }, 1000);
                }
            });


        });

    });
</script>
