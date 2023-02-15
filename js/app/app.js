"use strict";
$(document).ready(function () {
  $('#hidden').hide();

  $('#searchs').bind('keypress', function (e) {
    if (e.which == 13 || e.originalEvent.clipboardData != null) {
      var sohNum = $('#searchs').val();
      $.ajax({
        type: "POST",
        url: 'indexController.php',
        data: "userID=" + sohNum,
        success: function (data) {
          $('#hidden').show();
          var d = JSON.parse(data);
          console.log(data);
          //document.getElementById("numexpidition").innerHTML = d["SHIP0_1"].SHIPNUM;

          var table = $('#example').DataTable({
            createdRow: function (row, d, dataIndex) {
              if (d.PRCPQTY != d.SHIQTY) {
                $(row).css("background-color", "#50c878");
                $(row).css("color", "white");
              } else if (d.PRCPQTY == d.SHIQTY) {
                $(row).css("background-color", "red");
                $(row).css("color", "white");
              }
              
              $(row).attr("id", d.EANCOD);
            },
            data: d["SHIP1_1"],
            responsive: true,
            destroy: true,
            columns: [{
              data: "ITMREF",
              name: "code bares"
            },
            {
              data: "ITMDES",
            },
            ],
          });

          $('.dataTables_filter input').bind('keypress', function (e) {
            if (e.which == 13 || e.originalEvent.clipboardData != null) {
              if (e.originalEvent.clipboardData != null) {
                var pastedData = e.originalEvent.clipboardData.getData('text').toUpperCase();
              } else {
                var pastedData = $('.dataTables_filter input').val().toUpperCase();
              }
              var row = table.row('#' + pastedData).data();
              var filteredData = table.column(0).data()
                .filter(function (value, index) {
                  return value == pastedData ? true : false;
                });
                console.log(row);
            }
          });
        }
      });
    }
  });

});