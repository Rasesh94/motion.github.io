//Validation for the change password fields!
<script>
$(function(){
$("#changepassword").validate({
    rules: {
        oldpassword: {
        required: true,
        minlength: 5
      },
      newpassword: {
        required: true,
        minlength: 5
      },
      confirm_password: {
        required: true,
        minlength: 5,
        equalTo:"#newpassword"
      },

    },
    messages: {
      oldpassword: {
      required: "Please enter your old password.",
      minlength: "Your old password must consist of atleast 5 characters."
    },
    newpassword: {
      required: "Please enter your new password.",
      minlength: "Your new password must be atleast 5 characters long"
    },
    confirm_password: {
      required: "Please provide a password",
      minlength: "Your new password must be atleast 5 characters long",
      equalTo: "New passwords do not match!"
    }
    }

  });
});
</script>