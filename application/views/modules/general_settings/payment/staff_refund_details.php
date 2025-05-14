<div class="fv-row w-100 flex-md-root rounded border-gray-300 border-1 border-gray-300 border-dashed">
    <!--begin::Card header-->
    <div class="card-header pt-7">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder text-gray-800">Refund Summary & Transaction History</span>
            <span class="text-gray-400 mt-1 fw-bold fs-6">Designation - <?php echo $staff_details['designation']; ?></span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Filters-->
            <div class="d-flex flex-stack flex-wrap gap-4">
                <!--begin::Destination-->

                <!--end::Status-->
                <!--begin::Search-->
                <div class="position-relative my-1">
                    <h2 class="card-title align-items-end flex-column">Salary - <?php echo number_format($staff_details['salary'], 2); ?></h2>

                </div>
                <!--end::Search-->
            </div>
            <!--begin::Filters-->
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-2">
        <!--begin::Table-->
        <div id="kt_table_widget_4_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-3 dataTable no-footer" id="kt_table_widget_4_table">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">ID</th>
                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1">Created</th>
                            <th class="text-end min-w-125px sorting_disabled" rowspan="1" colspan="1">Description</th>
                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1">Amount</th>

                            <th class="text-end min-w-50px sorting_disabled" rowspan="1" colspan="1">Status</th>
                            <th class="text-end sorting_disabled" rowspan="1" colspan="1"></th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bolder text-gray-600">
                        <?php
                        $i = 1;
                        $total_refund = 0;
                        $total_approved = 0;
                        foreach ($staff_refund_details as $list) {
                            if ($list->approved == 1) {
                                $total_approved += $list->amount;
                            }
                        ?>
                            <tr>
                                <td>
                                    <a href="" class="text-gray-800 text-hover-primary"><?php echo $i; ?></a>
                                </td>
                                <td class="text-end"><?php echo date('d/m/Y', strtotime($list->date)); ?></td>
                                <td class="text-end">
                                    <a href="#" class="text-gray-600 text-hover-primary"><?php echo $list->description; ?></a>
                                </td>
                                <td class="text-end"><?php echo number_format($list->amount, 2); ?></td>

                                <td class="text-end">
                                    <?php
                                    if ($list->approved == 0) {
                                        echo '<span class="badge badge-warning">Pending</span>';
                                    } else if ($list->approved == 1) {
                                        echo '<span class="badge badge-success">Approved</span>';
                                    } else if ($list->approved == 2) {
                                        echo '<span class="badge badge-danger">Rejected</span>';
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php
                            $i++;
                        } ?>
                        <tr>
                            <td class="text-end" colspan="3"> <strong>Total Approved</strong></td>
                            <td class="text-end" colspan="2">
                                <h3 class="card-title">
                                    <?php echo number_format($total_approved, 2); ?>
                                </h3>
                            </td>
                            <td class="text-end"></td>
                        </tr>
                        <tr>
                            <td class="text-end" colspan="3"> <strong>Total Outstanding Balance</strong></td>
                            <td class="text-end" colspan="2">
                                <h3 class="card-title">
                                    <?php echo number_format($out_standing_balance, 2); ?>
                                </h3>
                            </td>
                            <td class="text-end"></td>
                        </tr>
                        <tr>
                            <td class="text-end" colspan="3"> <strong>Total Salary</strong></td>
                            <td class="text-end" colspan="2">
                                <h3 class="card-title">
                                    <?php echo number_format($out_standing_balance + $total_approved + $staff_details['salary'], 2); ?>
                                </h3>
                            </td>
                            <td class="text-end"></td>
                        </tr>

                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>
                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"></div>
            </div>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>