"use strict";

var KTFormsDaterangepickerDemos = {
    init: function () {
        // Basic Date Picker
        $("#kt_daterangepicker_1").daterangepicker();

        // DateTime Picker
        $("#kt_daterangepicker_2").daterangepicker({
            timePicker: true,
            startDate: moment().startOf("hour"),
            endDate: moment().startOf("hour").add(32, "hour"),
            locale: {
                format: "M/DD hh:mm A"
            }
        });

        // Single Date Picker with Age Calculation
        $("#kt_daterangepicker_3").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10)
        }, function (start, end, label) {
            var age = moment().diff(start, "years");
            // Example: console.log("You are " + age + " years old!");
        });

        // Predefined Range Picker
        (function () {
            var start = moment().subtract(29, "days");
            var end = moment();

            function updateDisplay(start, end) {
                $("#kt_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
            }

            $("#kt_daterangepicker_4").daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, updateDisplay);

            updateDisplay(start, end);
        })();

        // Basic Date Picker 2
        $("#kt_daterangepicker_5").daterangepicker();

        // Month-Only Picker
        $("#kt_month_picker").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: "MMMM YYYY"
            },
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10)
        }, function (start) {
            console.log("Selected month: " + start.format("MMMM YYYY"));
        });
    }
};

KTUtil.onDOMContentLoaded(function () {
    KTFormsDaterangepickerDemos.init();
});