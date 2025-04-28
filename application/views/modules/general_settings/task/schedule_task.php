<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="post d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container-xxl">

            <?php
            echo form_open_multipart('settings/add_client', array('id' => 'task_form', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
            ?>



            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Task Schedule</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Due Date</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Pick date" name="kt_daterangepicker_3" id="kt_daterangepicker_3" />
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Staff</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="staff" id="staff">
                                                <option value=""></option>
                                                <?php
                                                if (isset($staffs) && !empty($staffs)) {
                                                    foreach ($staffs as $staff) {

                                                        echo '<option value ="' . $staff->id . '">' . $staff->name . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">File</label>
                                            <input type="file" class="form-control files" name="receipt[]" id="receipt">
                                            <p style="font-size: 11px;">(file format-jpg, jpeg, png)(1333*277)</p>
                                        </div>

                                    </div>
                                    <div class="d-flex flex-wrap gap-5">


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Priority</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="priority" id="priority">
                                                <option value=""></option>
                                                <option value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Title</label>
                                            <input type="text" maxlength="30" name="title"
                                                class="form-control make-star mb-5" id="title"
                                                placeholder="Title">
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">

                                        </div>


                                    </div>
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Description</label>
                                            <textarea id="description" name="description"
                                                class="mb-5 form-control make-star" placeholder="Description"></textarea>
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
        var ops_url = baseurl + 'task/scheule-task-save';
        var staff = $('#staff').val();
        var priority = $('#priority').val();
        var due_date = $('#kt_daterangepicker_3').val();
        var title = $('#title').val();
        var description = $('#description').val();
        var receipt = $('#receipt').val();

        if (due_date == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Due date is required.'
            });
            return false;
        }
        if (staff == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Staff is required.'
            });
            return false;
        }
        if (receipt == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'File is required.'
            });
            return false;
        }
        if (priority == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Priority is required.'
            });
            return false;
        }
        if (title == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Title is required.'
            });
            return false;
        }
        if (description == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Description is required.'
            });
            return false;
        }

        $('#actual_submit').hide();
        $('#loader_submit').show();

        var form = $("#task_form");
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
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Task Assigned.'
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your request.'
                    });
                    $('#actual_submit').show();
                    $('#loader_submit').hide();
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.'
                });
            }
        });
    }
</script>