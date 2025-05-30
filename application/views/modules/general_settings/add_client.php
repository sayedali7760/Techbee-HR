<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="post d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container-xxl">

            <?php
            echo form_open_multipart('settings/add_client', array('id' => 'client_save', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
            ?>


            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Thumbnail</h2>
                        </div>
                    </div>
                    <div class="card-body text-center pt-0">
                        <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true"
                            style="background-image: url(assets/media/svg/files/blank-image.svg)">
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="avatar[]" id="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image
                            files are accepted</div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Add Staff</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">
                                        <!-- <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Role</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option" data-allow-clear="true"
                                                name="position" id="position">
                                                <option value=""></option>
                                                <php
                                            if (isset($user_role) && !empty($user_role)) {
                                                foreach ($user_role as $pos) {

                                                    echo '<option value ="' . $pos->role_id . '">' . $pos->description . '</option>';
                                                }
                                            }
                                            ?>
                                            </select>
                                        </div> -->

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Full Name</label>
                                            <input type="text" class="form-control mb-5" id="name" name="name"
                                                placeholder="First Name" maxlength="50">
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Email</label>
                                            <input type="text" class="form-control mb-5" id="email" name="email"
                                                placeholder="Email" maxlength="50">
                                        </div>

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Password</label>
                                            <input type="text" id="password" maxlength="15" name="password"
                                                class="mb-5 form-control make-star" id="" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Confirm Password</label>
                                            <input type="text" id="con_password" maxlength="15" name="con_password"
                                                class="form-control make-star mb-5" id=""
                                                placeholder="Confirm Password">
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">Country</label>
                                            <select class="form-select" data-placeholder="Select an option" id="kt_ecommerce_edit_order_billing_country" name="country">
                                                <?php foreach ($countries as $country) { ?>
                                                    <option value="<?php echo $country->country_code; ?>" data-kt-select2-country="<?php echo base_url(); ?><?php echo $country->flag_image_url; ?>"><?php echo $country->country_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Phone No</label>
                                            <input type="text" id="phone" name="phone"
                                                class="form-control numeric mb-5" id=""
                                                placeholder="Phone No" maxlength="12">
                                        </div>

                                    </div>
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Nationality</label>
                                            <input type="text" id="nationality" maxlength="50" name="nationality"
                                                class="form-control make-star mb-5"
                                                placeholder="Nationality">
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Designation</label>
                                            <input type="text" id="designation" maxlength="50" name="designation"
                                                class="form-control make-star mb-5"
                                                placeholder="Designation">
                                        </div>

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Salary</label>
                                            <input type="text" maxlength="10" name="salary"
                                                class="form-control make-star mb-5 numeric" id="salary"
                                                placeholder="Salary">
                                        </div>

                                    </div>
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Emirates ID</label>
                                            <input type="text" maxlength="50" name="eid"
                                                class="form-control make-star mb-5" id="eid"
                                                placeholder="Emirated ID">
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">

                                        </div>

                                        <div class="fv-row w-100 flex-md-root">

                                        </div>

                                    </div>

                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">

                                        <a href="<?php echo base_url(); ?>home" id="kt_ecommerce_add_product_cancel"
                                            class="btn btn-light me-5">Cancel</a>


                                        <a id="actual_submit" href="javascript:void(0);" class="btn btn-primary submit_butt" title="Save Changes"
                                            onclick="submit_data()">Save Changes</a>
                                        <a id="loader_submit" style="display:none;" href="javascript:void(0);" class="btn btn-primary" data-kt-indicator="on">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>


            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    function submit_data() {
        $("#actual_submit").hide();
        $("#loader_submit").show();
        var ops_url = baseurl + 'user-management/save-client';
        var name = $('#name').val();
        var password = $('#password').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var confirm_password = $('#con_password').val();
        var nationality = $('#nationality').val();
        var designation = $('#designation').val();
        var salary = $('#salary').val();
        var eid = $('#eid').val();

        if (name == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Name is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (email == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Email is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (phone == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Phone is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }

        if (password == '') {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Password is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (password.length < 3) {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Enter at least three characters for Password.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (confirm_password == '') {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Confirm Password is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (password != confirm_password) {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Password and Confirm Password must be the same.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (nationality == '') {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Nationality is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (designation == '') {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Designation is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (salary == '') {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Salary is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (eid == '') {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Emirates ID is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (eid.length < 3) {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Enter at least three characters for Emirates ID.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (phone.length < 3) {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Enter at least three characters for Phone.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (salary.length < 3) {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Enter at least three characters for Salary.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }

        var form = $("#client_save");
        var formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            processData: false,
            contentType: false,
            data: formData,
            success: function(result) {
                $("#loader").hide();
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Staff created.'
                    });
                    $('#client_save').trigger("reset");
                } else if (data.status == 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'Staff already exists.'
                    });
                } else {
                    $('#faculty_loader').removeClass('sk-loading');
                }
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.'
                });
            }
        });
    }
</script>