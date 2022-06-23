function getBaseURL() {
    return location.protocol + "//" + location.hostname + (location.port && ":" + location.port) + "/";
}
var pageUrl = getBaseURL();
$(document).ready(function getCount() {

    $.ajax({
        url: pageUrl + "count_works",
        dataType: 'json',
        success: function(data) {
            // ĐIỆN NƯỚC
            var sum_elec = data.data_elec.sum_elec;
            var work_elec_distribution = data.data_elec.work_elec_distribution;
            var work_no_elec_distribution = data.data_elec.work_no_elec_distribution;
            var work_elec_cancle = data.data_elec.work_elec_cancle;
            // ĐIỆN LẠNH
            var sum_air = data.data_air.sum_air;
            var work_air_distribution = data.data_air.work_air_distribution;
            var work_no_air_distribution = data.data_air.work_no_air_distribution;
            var work_air_cancle = data.data_air.work_air_cancle;
            // ĐỒ GỖ
            var sum_wood = data.data_wood.sum_wood;
            var work_wood_distribution = data.data_wood.work_wood_distribution;
            var work_no_wood_distribution = data.data_wood.work_no_wood_distribution;
            var work_wood_cancle = data.data_wood.work_wood_cancle;
            // XÂY DỰNG
            var sum_build = data.data_build.sum_build;
            var work_build_distribution = data.data_build.work_build_distribution;
            var work_no_build_distribution = data.data_build.work_no_build_distribution;
            var work_build_cancle = data.data_build.work_build_cancle;
            // KHÁC
            var sum_else = data.data_else.sum_else;
            var work_else_distribution = data.data_else.work_else_distribution;
            var work_no_else_distribution = data.data_else.work_no_else_distribution;
            var work_else_cancle = data.data_else.work_else_cancle;

            // ĐIỆN NƯỚC
            document.getElementById("sum_elec").innerHTML = sum_elec;
            document.getElementById("work_elec_distribution").innerHTML = work_elec_distribution;
            document.getElementById("work_no_elec_distribution").innerHTML = work_no_elec_distribution;
            document.getElementById("work_elec_cancle").innerHTML = work_elec_cancle;
            // ĐIỆN LẠNH
            document.getElementById("sum_air").innerHTML = sum_air;
            document.getElementById("work_air_distribution").innerHTML = work_air_distribution;
            document.getElementById("work_no_air_distribution").innerHTML = work_no_air_distribution;
            document.getElementById("work_air_cancle").innerHTML = work_air_cancle;
            // ĐỒ GỖ
            document.getElementById("sum_wood").innerHTML = sum_wood;
            document.getElementById("work_wood_distribution").innerHTML = work_wood_distribution;
            document.getElementById("work_no_wood_distribution").innerHTML = work_no_wood_distribution;
            document.getElementById("work_wood_cancle").innerHTML = work_wood_cancle;
            // XÂY DỰNG
            document.getElementById("sum_build").innerHTML = sum_build;
            document.getElementById("work_build_distribution").innerHTML = work_build_distribution;
            document.getElementById("work_no_build_distribution").innerHTML = work_no_build_distribution;
            document.getElementById("work_build_cancle").innerHTML = work_build_cancle;
            // KHÁC
            document.getElementById("sum_else").innerHTML = sum_else;
            document.getElementById("work_else_distribution").innerHTML = work_else_distribution;
            document.getElementById("work_no_else_distribution").innerHTML = work_no_else_distribution;
            document.getElementById("work_else_cancle").innerHTML = work_else_cancle;

        }
    });
});