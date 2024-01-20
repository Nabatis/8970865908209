<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h1>Forget Password</h1>

<form id="forgetForm">
    <input type="email" name="email" placeholder="Enter Email" required>
    <br><br>
    <input type="submit" value="Forget password">
</form>

<div class="result"></div>  

<script>
    $(document).ready(function() {

        $("#forgetForm").submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "http://127.0.0.1:8000/api/auth/forget-password",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.success == true) {
                        $(".result").text(data.msg);
                    } else {
                        $(".result").text(data.msg);
                        setTimeout(() => {
                            $(".result").text("");
                        }, 2000);
                    }
                }
            });
        });
    });
</script>
