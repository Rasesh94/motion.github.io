//Validation for the fields!
<script>
$(function(){
$("#adduser").validate({
    rules: {
        username: {
        required: true,
        minlength: 5
      },
      password: {
        required: true,
        minlength: 5
      },
      confirm_password: {
        required: true,
        minlength: 5,
        equalTo:"#password"
      },
      email: {
        required: true,
        email: true
      }

    },
    messages: {
      username: {
      required: "Please enter a username.",
      minlength: "Your username must consist of atleast 5 characters."
    },
    password: {
      required: "Please provide a password",
      minlength: "Your password must be atleast 5 characters long"
    },
    confirm_password: {
      required: "Please provide a password",
      minlength: "Your password must be atleast 5 characters long",
      equalTo: "Passwords do not match!"
    }
    }

  });
});
</script>