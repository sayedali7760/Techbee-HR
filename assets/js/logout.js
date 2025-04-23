

function getRoundoff(amount, country) {
    int_part = Math.trunc(amount); // returns 3
    float_part = Number((amount - int_part).toFixed(2)); // return 0.2

    if (country == "INDIA") {
        if (float_part >= 0.5) {
            // if greater than or equal to 0.5 => round off to top
            ret_amount = int_part * 1 + 1 * 1;
        } else if (float_part < 0.5) {
            // if less than 0.5 => round off to bottom
            ret_amount = int_part;
        } else {
            ret_amount = amount;
        }
    } else if (country == "UAE") {
        if (float_part <= 0.1) {
            ret_amount = int_part;
        } else if (float_part > 0.1 && float_part <= 0.25) {
            ret_amount = int_part * 1 + 0.25 * 1;
        } else if (float_part > 0.25 && float_part <= 0.5) {
            ret_amount = int_part * 1 + 0.5 * 1;
        } else if (float_part > 0.5 && float_part <= 0.75) {
            ret_amount = int_part * 1 + 0.75 * 1;
        } else if (float_part > 0.75 && float_part <= 0.99) {
            ret_amount = int_part * 1 + 1 * 1;
        }
    }
    return ret_amount;
}

function logout_confirm() {
    swal(
        {
            title: "",
            text: "Are you sure to log out from the application?",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false
        },
        function (isconfirm) {
            if (isconfirm) {
                window.location.href = baseurl + "/logout";
            }
        }
    );
}

//**Common Javascript Functions End */

jQuery(function ($) {

    $(document).on("focus", ".admnNumberCheck", function () {
        $(this).attr("maxlength", "10");
    });
    $(document).on("focus", ".max20", function () {
        $(this).attr("maxlength", "20");
    });
    $(document).on("focus", ".max50", function () {
        $(this).attr("maxlength", "50");
    });
    $(document).on("focus", ".max60", function () {
        $(this).attr("maxlength", "60");
    });
    $(document).on(
        "focus",
        ".dataTables_filter input[type='search']",
        function () {
            $(this).attr("maxlength", "10");
        }
    );
    $(document).on("focus", ".decimalCheck", function () {
        $(this).attr("maxlength", "8");
    });

    $(document).on("focus", ".decimalCheck_perc", function () {
        $(this).attr("maxlength", "3"); //6 changed to 3
    });

    $(document).on("click", ".btn,a.sidemenulink", function () {
        $("input:text:visible:first")
            .not("#reportdate")
            .not("#datepicker")
            .not("#datefilter")
            .not(".nofocusitem")
            .not(".is-datepicker")
            .focus();
    });

    //PREVENTING PASTE DROP DRAG INTO TEXTBOX
    $(document).on("paste drag drop", ".disabledragpaste", function (e) {
        e.preventDefault();
    });

    // Validation of Textboxes
    $(document).on("keypress", ".numeric", function (e) {
        var dec_numbers = /[0-9]|\.+?$/;
        if (!dec_numbers.test(e.key)) {
            return false;
        } else {
            return true;
        }
    });
    $(document).on("keypress", ".digits", function (e) {
        var dec_numbers = /[0-9]+?$/;
        if (!dec_numbers.test(e.key)) {
            return false;
        } else {
            return true;
        }
    });
    $(document).on("keypress", ".numericDecimal", function (evt) {
        //$(".numericDecimal").on("keypress", function (evt) {
        var $txtBox = $(this);
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
            return false;
        } else {
            var len = $txtBox.val().length;
            var index = $txtBox.val().indexOf('.');
            if (index >= 0 && charCode == 46) {
                return false;
            }
            if (index >= 0) {
                var charAfterdot = (len + 1) - index;
                if (charAfterdot > 3) {
                    return false;
                }
            }
        }
        return $txtBox; //for chaining
    });
    $(document).on("keypress", ".alphanumeric", function (e) {
        var alphanumeric = /[\w]|\-|\s+?$/;
        if (!alphanumeric.test(e.key)) {
            return false;
        } else {
            return true;
        }
    });
    $(document).on("keypress", ".alpha", function (e) {
        var alpha = /[a-zA-Z]|\-|\s+?$/;
        if (!alpha.test(e.key)) {
            return false;
        } else {
            return true;
        }
    });
    $(document).on("keypress", ".alphaNoSpace", function (e) {
        var alphaNoSpace = /^[a-zA-Z0-9]*$/;
        if (!alphaNoSpace.test(e.key)) {
            return false;
        } else {
            return true;
        }
    });
    $(document).on("keypress", ".admnNumberCheck", function (e) {
        var regex = new RegExp("^[t-tT-T0-9/]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

        e.preventDefault();
        return false;
    });




    //Function to allow only Decimal values to textbox
    $(document).on("keypress", ".decimalCheck,.decimalCheck_perc", function (key) {
        //getting key code of pressed key
        var keycode = key.which ? key.which : key.keyCode;
        //comparing pressed keycodes
        if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57)) {
            return false;
        } else {
            //var parts = key.srcElement.value.split('.');
            var parts = $(this)
                .val()
                .split(".");
            if (parts.length > 1 && keycode == 46) return false;
            return true;
        }
    });
    //**Other Common Jquery End
});
