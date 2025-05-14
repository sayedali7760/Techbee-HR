<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="post d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container-xxl">

            <?php
            echo form_open_multipart('settings/add_client', array('id' => 'payroll_payment', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
            ?>



            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Payroll Payment</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Staff Name</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="staff" id="staff" onchange="get_staff_refund_details()">
                                                <option value=""></option>
                                                <?php
                                                if (isset($staff_details) && !empty($staff_details)) {
                                                    foreach ($staff_details as $staff) {

                                                        echo '<option value ="' . $staff->id . '">' . $staff->name . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Month</label>
                                            <input type="text" onchange="get_staff_refund_details()" class="form-control form-control-solid" placeholder="Pick date" name="kt_month_picker" id="kt_month_picker" />
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Amount</label>
                                            <input type="text" class="form-control mb-5 numeric" id="amount" name="amount"
                                                placeholder="Amount" maxlength="10">
                                        </div>


                                    </div>
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">Bonus</label>
                                            <input type="text" class="form-control mb-5 numeric" id="bonus" name="bonus"
                                                placeholder="Bonus" maxlength="10">
                                        </div>

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">Receipt</label>
                                            <input type="file" class="form-control files" name="receipt[]" id="receipt">
                                            <p style="font-size: 11px;">(file format-jpg, jpeg, png)(1333*277)</p>
                                        </div>


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Description</label>
                                            <input type="text" id="description" name="description"
                                                class="mb-5 form-control make-star" placeholder="Description">
                                        </div>

                                    </div>
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Bank</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="bank" id="bank">
                                                <option value=""></option>

                                            </select>
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
                                    <div class="d-flex px-7 py-3 mb-6 justify-content-end">

                                        <a href="<?php echo base_url(); ?>home" id="kt_ecommerce_add_product_cancel"
                                            class="btn btn-light me-5">Cancel</a>


                                        <a id="actual_submit" href="javascript:void(0);" class="btn btn-primary submit_butt" title="Save Changes"
                                            onclick="submit_payroll_data()">Save Changes</a>
                                        <a id="loader_submit" style="display:none;" href="javascript:void(0);" class="btn btn-primary" data-kt-indicator="on">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </a>

                                    </div>
                                    <div id="kt_child_post">
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
    function get_staff_refund_details() {
        var staff_id = $('#staff').val();
        var month = $('#kt_month_picker').val();
        var ops_url = baseurl + 'client/get-staff-refund-details';
        if (staff_id == "") {
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "staff_id": staff_id,
                "month": month
            },
            success: function(result) {
                console.log(result);
                var data = $.parseJSON(result);
                $("#kt_child_post").html(data.view);
                $('#kt_child_post').addClass('in-down');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
                if (Array.isArray(data.bank_details)) {
                    var $bankSelect = $('#bank');
                    $bankSelect.empty().append('<option value=""></option>'); // reset with placeholder
                    data.bank_details.forEach(function(bank) {
                        $bankSelect.append(`<option value="${bank.id}">${bank.bank_name}</option>`);
                    });

                    // Reinitialize Select2 if necessary
                    $bankSelect.select2();
                }
            }
        });
    }

    function submit_payroll_data() {
        $("#actual_submit").hide();
        $("#loader_submit").show();

        var ops_url = baseurl + 'client/payroll-payment-save';

        var date = $('#kt_month_picker').val();
        var staff = $('#staff').val();
        var amount = $('#amount').val();
        var bonus = $('#bonus').val();
        var description = $('#description').val();
        var receipt = $('#receipt').val();
        var bank = $('#bank').val();

        if (date == "") {
            Swal.fire({
                icon: 'info',
                text: 'Date is required.'
            });
            toggleButtons();
            return false;
        }

        if (staff == "") {
            Swal.fire({
                icon: 'info',
                text: 'Staff is required.'
            });
            toggleButtons();
            return false;
        }
        if (amount == "") {
            Swal.fire({
                icon: 'info',
                text: 'Amount is required.'
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
        if (bank == "") {
            Swal.fire({
                icon: 'info',
                text: 'Bank is required.'
            });
            toggleButtons();
            return false;
        }


        var form = $("#payroll_payment"); // make sure your form has this ID
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
                        text: 'Payroll Payment submitted.'
                    }).then(() => {
                        location.reload();
                    });
                } else if (data.status == 3) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: data.message || 'Payment already exist for this month.'
                    });
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