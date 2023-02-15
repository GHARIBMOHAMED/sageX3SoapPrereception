<?php
session_start();
require_once('WebService/models/Connect.php');

if (isset($_SESSION["x3login"])) {
  $x3login = $_SESSION["x3login"];
  $x3passwd = $_SESSION["x3passwd"];

  $x3Connect = new Connect($x3login, $x3passwd);
  $isConnect = $x3Connect->isConnect();
} else {
  header('Location:http://localhost:8888/reception/sign-in.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- heade here -->
<?php include("includes/head.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

<body>
  <!-- page-->
  <div class="page">
    <?php include("includes/menu_home.php"); ?>
    <!-- sidebar-->
    <?php include("includes/sidebar.php"); ?>
    <div class="overlay"></div>
    <!-- inner-->
    <div class="page__inner">
      <div class="page__container">
        <div class="page__title h3">
          <div id="numexpidition"></div>
        </div>
        <div class="create__card card">
          <div class="card__head">
            <div class="title-purple card__title">Liste de préreception.</div>
          </div>
          <div class="field">
            <div class="field__wrap">
              <select class="select" id="searchs" name="formsohnum">
                <option>Selectionez préreception</option>
                <?php
                require_once('WebService/models/PreCommand.php');
                $order = new PreCommande();
                echo $order->showListe();
                ?>
              </select>
            </div>
          </div>

        </div>

        <div class="customer card" id="hidden">
          <div class="card__body">
            <table id="example">
              <thead>
                <tr>
                  <th>Code a bares</th>
                  <th>Designation</th>
                  <th>Article</th>
                  <th>quanité</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="panel" id="hidden2">
          <div class="panel__btns">
            <button class="button-stroke panel__button" id="save">Créer</button>
            <button class="button panel__button" id="sold">Solder réception</button>
            <div class="actions actions_up">
              <button class="actions__button">
                <svg class="icon icon-more-horizontal">
                  <use xlink:href="#icon-more-horizontal"></use>
                </svg>
              </button>
              <div class="actions__body">
                <button class="actions__option js-preview-open" id="preview">
                  <svg class="icon icon-expand">
                    <use xlink:href="#icon-expand"></use>
                  </svg>Afficher
                </button>
                <button class="actions__option" id="clear">
                  <svg class="icon icon-close">
                    <use xlink:href="#icon-close"></use>
                  </svg>Vider le cache
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- scripts-->
  <?php include("includes/end_body.php"); ?>

</body>
<script>
  "use strict";
  $(document).ready(function() {
    $('#hidden').hide();
    $('#hidden2').hide();


    $("#sold").click(function() {
      //alert( "Handler for .click() called." );
    });

    $("#clear").click(function() {
      localStorage.clear();
    });

    $("#preview").click(function() {
      $('#hidden').hide() ? $('#hidden').show() : $('#hidden').hide();
    });
    $('#searchs').on('change', function(e) {
      var sohNum = this.value;
      //console.log(sohNum);
      //localStorage.getItem(sohNum) === null
      if (localStorage.getItem(sohNum) === null) {
        $.ajax({
          type: "POST",
          url: 'indexController.php',
          data: "userID=" + sohNum,
          success: function(data) {
            $('#hidden').show();
            $('#hidden2').show();

            //localStorage.removeItem('list');
            var rawData = JSON.parse(data);
            var d = rawData.datas;


            // Store the object into storage
            //var object = {timestamp: new Date().getTime()}
            // all = d.concat(object)
            localStorage.setItem(rawData[0].SHIPNUM, JSON.stringify(d));

            var table = $('#example').DataTable({
              createdRow: function(row, d, dataIndex) {
                if (d.PRCPQTY != d.SHIQTY) {
                  $(row).css("background-color", "red");
                  $(row).css("color", "white");
                } else if (d.PRCPQTY == d.SHIQTY) {
                  $(row).css("background-color", "#50c878");
                  $(row).css("color", "white");
                }

                $(row).attr("id", 'row-' + d.EANCOD);
              },
              data: d,
              responsive: true,
              destroy: true,
              pageLength: 500,
              bPaginate: false,
              columns: [{
                  data: "EANCOD",
                  name: "code bares"
                },
                {
                  data: "ITMREF",
                },
                {
                  data: "ITMDES",
                },
                {
                  data: "PRCPQTY",
                },
              ]
            });
            $('div.dataTables_filter input', table.table().container()).focus();

            //save data in sage
            $("#save").click(function() {
              var sohNum2 = $("#searchs :selected").text();
              var datass = localStorage.getItem(sohNum2);

              $.ajax({
                type: "POST",
                url: 'ReceptionController.php',
                data: {
                  user: JSON.parse(datass)
                },
                success: function(response) {
                  console.log(response.replace(/\s/g, ''))
                  if (response.replace(/\s/g, '') == "1") {
                    localStorage.removeItem(sohNum2)
                    Swal.fire({
                      icon: 'success',
                      title: 'Succes',
                      text: 'Réception crée avec succes',
                      showConfirmButton: false,
                      timer: 2000
                    });
                    sohNum2 = '';
                    datass = '';
                    location.reload();
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'Succes',
                      text: 'quelque chose s\'est mal passé',
                      showConfirmButton: false,
                      timer: 2000
                    });
                    sohNum2 = '';
                    datass = '';
                    location.reload();
                  }

                }
              });
            });

            $('.dataTables_filter input').bind('keypress', function(e) {
              if (e.which == 13 || e.originalEvent.clipboardData != null) {
                if (e.originalEvent.clipboardData != null) {
                  var pastedData = e.originalEvent.clipboardData.getData('text').toUpperCase();
                } else {
                  var pastedData = $('.dataTables_filter input').val().toUpperCase();
                }
                var row = table.row('#row-' + pastedData).data();
                var filteredData = table.column(0).data()
                  .filter(function(value, index) {
                    return value == pastedData ? true : false;
                  });

                if (filteredData.length == 1) {

                  var filteredDataquantite = row;
                  var codeBar = row[0];
                  var quantite;
                  Swal.fire({
                    text: 'Combien d\'article vous trouvez ?',
                    input: 'number',
                  }).then((result) => {

                    if (result.value != '' && result.value.length != 13) {
                      quantite = result.value
                    } else {
                      quantite = 'erorr';
                    }
                    if (result.isConfirmed && quantite != 'erorr') {
                      //modifier le JSON d si le code scanner existe dans le table apres comparez le code a bares
                      $.each(d, function(key, value) {
                        if (d[key].EANCOD == pastedData) {
                          d[key].PRCPQTY = quantite;
                          table.search('').draw();
                        }
                      });

                    } else {
                      Swal.fire({
                        icon: 'warning',
                        title: 'valeur invalide',
                        text: 'erreur',
                        showConfirmButton: false,
                        timer: 1900
                      });
                      table.search('').draw();
                    }

                  });

                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Code a bares introuvable',
                    showConfirmButton: false,
                    timer: 1900
                  });
                  table.search('').draw();
                }
              }
            });
          }
        });
      } else {
        $('#hidden').show();
        $('#hidden2').show();
        var d2 = JSON.parse(localStorage.getItem(sohNum));
        //console.log(d2)

        var table = $('#example').DataTable({
          createdRow: function(row, d2, dataIndex) {
            if (d2.PRCPQTY != d2.SHIQTY) {
              $(row).css("background-color", "red");
              $(row).css("color", "white");
            } else if (d2.PRCPQTY == d2.SHIQTY) {
              $(row).css("background-color", "#50c878");
              $(row).css("color", "white");
            }

            $(row).attr("id", 'row-' + d2.EANCOD);
          },
          data: d2,
          responsive: true,
          destroy: true,
          pageLength: 500,
          bPaginate: false,
          columns: [{
              data: "EANCOD",
              name: "code bares"
            },
            {
              data: "ITMREF",
            },
            {
              data: "ITMDES",
            },
            {
              data: "PRCPQTY",
            },
          ],
        });
        //save data in sage
        $("#save").click(function() {
          var sohNum2 = $("#searchs :selected").text();
          var datass = localStorage.getItem(sohNum2);

          $.ajax({
            type: "POST",
            url: 'ReceptionController.php',
            data: {
              user: JSON.parse(datass)
            },
            success: function(response) {
              console.log(response.replace(/\s/g, ''))
              if (response.replace(/\s/g, '') == "1") {
                localStorage.removeItem(sohNum2)
                Swal.fire({
                  icon: 'success',
                  title: 'Succes',
                  text: 'Réception crée avec succes',
                  showConfirmButton: false,
                  timer: 2000
                });
                sohNum2 = '';
                datass = '';
                location.reload();
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Succes',
                  text: 'quelque chose s\'est mal passé',
                  showConfirmButton: false,
                  timer: 2000
                });
                sohNum2 = '';
                datass = '';
                location.reload();
              }

            }
          });
        });

        $('div.dataTables_filter input', table.table().container()).focus();
        $('.dataTables_filter input').bind('keypress', function(e) {
          if (e.which == 13 || e.originalEvent.clipboardData != null) {
            if (e.originalEvent.clipboardData != null) {
              var pastedData = e.originalEvent.clipboardData.getData('text').toUpperCase();
            } else {
              var pastedData = $('.dataTables_filter input').val().toUpperCase();
            }
            var row = table.row('#row-' + pastedData).data();
            var filteredData = table.column(0).data()
              .filter(function(value, index) {
                return value == pastedData ? true : false;
              });

            if (filteredData.length == 1) {

              var filteredDataquantite = row;
              var codeBar = row[0];
              var quantite;
              Swal.fire({
                text: 'Combien d\'article vous trouvez ?',
                input: 'number',
              }).then((result) => {

                if (result.value != '' && result.value.length != 13) {
                  quantite = result.value
                } else {
                  quantite = 'erorr';
                }
                if (result.isConfirmed && quantite != 'erorr') {
                  //modifier le JSON d si le code scanner existe dans le table apres comparez le code a bares
                  $.each(d2, function(key, value) {
                    if (d2[key].EANCOD == pastedData) {
                      d2[key].PRCPQTY = quantite;
                      //update localstorage
                      localStorage.removeItem(sohNum);
                      localStorage.setItem(sohNum, JSON.stringify(d2));
                      table.clear().rows.add(d2).draw();
                      table.search('').draw();
                      $('div.dataTables_filter input', table.table().container()).focus();
                    }
                  });

                } else {
                  Swal.fire({
                    icon: 'warning',
                    title: 'valeur invalide',
                    text: 'erreur',
                    showConfirmButton: false,
                    timer: 1900
                  });
                  table.search('').draw();
                }

              });

            } else {
              Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Code a bares introuvable',
                showConfirmButton: false,
                timer: 1900
              });
              table.search('').draw();
            }
          }
        });
        // dateString = d2.timestamp,
        // now = new Date().getTime().toString();
        // compareTime(dateString, now); //to implement
        // console.log(compareTime(dateString, now))
      }
    });


  });
</script>

</html>