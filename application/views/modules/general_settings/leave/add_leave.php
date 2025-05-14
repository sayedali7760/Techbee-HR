<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="post d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container-xxl">

            <?php
            echo form_open_multipart('settings/add_client', array('id' => 'leave_form', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
            ?>



            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Leave Apply</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Date</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Pick date" name="kt_daterangepicker_3" id="kt_daterangepicker_3" />
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Leave Type</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="leave_type" id="leave_type">
                                                <option value=""></option>
                                                <option value="1">Casual Leave</option>
                                                <option value="2">Sick Leave</option>
                                                <option value="3">Annual Leave</option>
                                                <option value="4">Maternity Leave</option>
                                                <option value="5">Paternity Leave</option>
                                            </select>
                                        </div>

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Description</label>
                                            <input type="text" id="description" name="description"
                                                class="mb-5 form-control make-star" placeholder="Description">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">File</label>
                                            <input type="file" class="form-control files" name="file[]" id="file">
                                            <p style="font-size: 11px;">(file format-jpg, jpeg, png, pdf)</p>
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">

                                        </div>

                                        <div class="fv-row w-100 flex-md-root">

                                        </div>
                                    </div>

                                    <div class="fv-row w-100 flex-md-root">
                                        <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                            <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="currentColor"></path>
                                                    <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="currentColor"></path>
                                                    <rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="currentColor"></rect>
                                                    <path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                <h4 class="fw-bold">This is an alert</h4>
                                                <span>Submit your leave request by selecting the leave type, specifying the date range, and providing a reason.
                                                    Your application will be reviewed by your reporting manager. You will be notified once your request is approved or rejected.</span>
                                            </div>
                                            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                    </svg>
                                                </span>
                                            </button>
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

        var ops_url = baseurl + 'leave/leave-save';

        var date = $('#kt_daterangepicker_3').val();
        var leave_type = $('#leave_type').val();
        var description = $('#description').val();

        if (date == "") {
            Swal.fire({
                icon: 'info',
                text: 'Date is required.'
            });
            toggleButtons();
            return false;
        }

        if (leave_type == "") {
            Swal.fire({
                icon: 'info',
                text: 'Type is required.'
            });
            toggleButtons();
            return false;
        }

        if (description == "") {
            Swal.fire({
                icon: 'info',
                text: 'Description is required.'
            });
            toggleButtons();
            return false;
        }


        var form = $("#leave_form"); // make sure your form has this ID
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
                $("#loader_submit").hide();
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Leave Applied.'
                    });
                    form.trigger("reset");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: data.message || 'Something went wrong.'
                    });
                }
                $("#actual_submit").show();
            },
            error: function(xhr, status, error) {
                $("#loader_submit").hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong while submitting.'
                });
                $("#actual_submit").show();
            }
        });

        function toggleButtons() {
            $("#actual_submit").show();
            $("#loader_submit").hide();
        }
    }
</script>