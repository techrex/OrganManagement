$(function () {
    var table = $("#retable").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "ajax": '/manage/recruit/get',
        "columns": [
            { "data": "id" },
            { "data": "stuid" },
            { "data": "realname" },
            { "data": "sex" },
            { "data": "class" },
            { "data": "mobile_long" },
            { "data": "mobile_short" },
            { "data": "otherclub" },
            { "data": "resume" }
        ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return data == '2' ? '女' : '男';
                },
                "targets": 3
            },
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    var classArray = ['通信一班', '通信二班', '通信三班', '通信四班', '通信五班', '通信六班', '通信七班', '通信八班', '通信九班', '中英一班', '中英二班'];
                    return classArray[parseInt(data, 10)-1];
                },
                "targets": 4
            }
        ],
        "dom": 'Bfrtip',
        "lengthMenu": [
            [ 10, 25, 50, -1 ],
            [ '10 行', '25 行', '50 行', '显示全部' ]
        ],
        "buttons": [
            'pageLength',
            {
                "extend": 'excelHtml5',
                "title": '线上报名统计名单'
            },
            'print',
            {
                "text": '<i class="fa fa-refresh"></i> 刷新',
                "action": function ( e, dt, node, config ) {
                    Pace.restart();
                    dt.ajax.reload();
                }
            }
        ],
        "language": {
            "sProcessing":   "处理中...",
            "sLengthMenu":   "显示 _MENU_ 项结果",
            "sZeroRecords":  "没有匹配结果",
            "sInfo":         "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
            "sInfoEmpty":    "显示第 0 至 0 项结果，共 0 项",
            "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
            "sInfoPostFix":  "",
            "sSearch":       "搜索:",
            "sUrl":          "",
            "sEmptyTable":     "表中数据为空",
            "sLoadingRecords": "载入中...",
            "sInfoThousands":  ",",
            "oPaginate": {
                "sFirst":    "首页",
                "sPrevious": "上页",
                "sNext":     "下页",
                "sLast":     "末页"
            },
            "oAria": {
                "sSortAscending":  ": 以升序排列此列",
                "sSortDescending": ": 以降序排列此列"
            },
            "buttons": {
                "pageLength": {
                    _: '显示 %d 项结果',
                    "-1": '显示全部'
                },
                "excel": "导出Excel表格",
                "print": "打印"
            }
        }
    }),form_validate = function() {
            var zh_cn = {
                lengthBadStart: '必须是 ',
                lengthBadEnd: ' 位',
            }
            $.validate({
                form : '#reform',
                language : zh_cn
            });
            $("#otherclub").restrictLength($('#maxlength1'));
            $("#resume").restrictLength($('#maxlength2'));
    };
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    form_validate();
});
