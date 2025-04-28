<div id="kt_content_container" class="container-xxl">

    <div class="card card-flush py-4 flex-row-fluid">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Refund Details</h2>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        <!--begin::IP address-->
                        <tr>
                            <td class="text-muted">Amount</td>
                            <td class="fw-bolder text-end"><?php echo number_format($refund_details_single->amount, 2); ?></td>
                        </tr>
                        <!--end::IP address-->

                        <!--begin::User agent-->
                        <tr>
                            <td class="text-muted">Description</td>
                            <td class="fw-bolder text-end"><?php echo $refund_details_single->description; ?></td>
                        </tr>
                        <!--end::User agent-->
                        <!--begin::Accept language-->
                        <tr>
                            <td class="text-muted">File</td>
                            <td class="fw-bolder text-end"><a title="Download" target="_blank" href="<?php echo base_url() ?>uploads/<?php echo $refund_details_single->file; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                            <path opacity="0.3" d="M13 14.4V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V14.4H13Z" fill="currentColor" />
                                            <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM13 14.4V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V14.4H8L11.3 17.7C11.7 18.1 12.3 18.1 12.7 17.7L16 14.4H13Z" fill="currentColor" />
                                        </svg></span>
                                </a></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Created On</td>
                            <td class="fw-bolder text-end"><?php echo date('d/m/Y', strtotime($refund_details_single->created_on)); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
                            <td class="fw-bolder text-end"><?php
                                                            if ($refund_details_single->approved == 0) {
                                                                echo '<span class="badge badge-warning">Pending</span>';
                                                            } else if ($refund_details_single->approved == 1) {
                                                                echo '<span class="badge badge-success">Completed</span>';
                                                            } else if ($refund_details_single->approved == 2) {
                                                                echo '<span class="badge badge-danger">rejected</span>';
                                                            }
                                                            ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted"></td>
                            <td class="fw-bolder text-end"><a href="javascript:void(0);" onclick="cancel()"
                                    class="btn btn-danger">Cancel</a></td>
                        </tr>
                        <!--end::Accept language-->
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
        </div>
        <!--end::Card body-->
    </div>
</div>
<script>
    function cancel() {
        location.reload();
    }
</script>