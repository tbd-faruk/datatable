<?php include('connection.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
  <title>Server Side CRUD Ajax Operations</title>
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <h2 class="text-center">Welcome to Datatable</h2>
    <p class="datatable design text-center">Welcome to Datatable</p>
      <div class="row mb-5">
          <div class="col-2"></div>
            <div class="col-2">
              <div class="form-group">
                  <label for="">Name and Region Search</label>
                  <input type="text" name="name" id="name" data-columns="1">
              </div>
          </div>
            <div class="col-2">
              <div class="form-group">
                  <label for="">Region</label>
                  <select name="region" id="region" data-columns="4" class="form-control">
                      <option value="">Please Select</option>
                      <option value="Asia">Asia</option>
                      <option value="Europe">Europe</option>
                      <option value="Polar">Polar</option>
                      <option value="Americas">Americas</option>
                      <option value="Europe">Europe</option>
                      <option value="Oceania">Oceania</option>
                  </select>
              </div>
          </div>
            <div class="col-2">
          <div class="form-group">
              <label for="">Show/Hide Column</label>
              <select name="column_name" id="column_name" class="form-control selectpicker" multiple>
                  <option value="0">ID</option>
                  <option value="1">Name</option>
                  <option value="2">Latitude</option>
                  <option value="3">Longitude</option>
                  <option value="4">Region</option>
                  <option value="5">Subregion</option>
              </select>
          </div>
        </div>
      </div>



        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <table id="example" class="table" style="width: 100%;">
              <thead>
                <th>Id</th>
                <th>Name</th>
                <th>latitude</th>
                <th>longitude</th>
                <th>region</th>
                <th>subregion</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>

  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


  <script type="text/javascript">
      $.fn.dataTable.ext.search.push(
          function( settings, data, dataIndex ) {
              var min = parseInt( $('#min').val(), 10 );
              var max = parseInt( $('#max').val(), 10 );
              var latitude = parseFloat( data[2] ) || 0; // use data for the latitude column

              if ( ( isNaN( min ) && isNaN( max ) ) ||
                  ( isNaN( min ) && latitude <= max ) ||
                  ( min <= latitude   && isNaN( max ) ) ||
                  ( min <= latitude   && latitude <= max ) )
              {
                  return true;
              }
              return false;
          }
      );
    $(document).ready(function() {
        loading = 'img/loader.gif';
    var table =  $('#example').DataTable({
          "bSort": true,
          "lengthMenu": [[10, 20, 50, 100, 200,-1],[10,20,50,100,200,"All"]],
          "iDisplayLength": 50,
          "processing": true,
          "serverSide": true,
          "paging": true,
          "pagingType": "full_numbers",
          "searching": true,
          "dom": 'Bfrtip',
          "buttons": [
              // {
              //     extend: 'copy',
              //     text: '<u>C</u>opy',
              //     action: function ( e, dt, node, config ) {
              //         this.disable(); // disable button
              //     },
              //     key: {
              //         key: 'c',
              //         altKey: true
              //     }
              // },
              {
                  extend: 'copy',
                  serverSide: true,
                  exportOptions: {
                      columns: [ [0,1], ':visible' ],
                      modifier: {
                          page: 'current'
                      }
                  },
                  // action: function (e, dt, button, config)
                  // {
                  //     dt.one('preXhr', function (e, s, data)
                  //     {
                  //         data.length = -1;
                  //     }).one('draw', function (e, settings, json, xhr)
                  //     {
                  //         var excelButtonConfig = $.fn.DataTable.ext.buttons.excelHtml5;
                  //         var addOptions = { exportOptions: { 'columns': ':all'} };
                  //
                  //         $.extend(true, excelButtonConfig, addOptions);
                  //         excelButtonConfig.action(e, dt, button, excelButtonConfig);
                  //     }).draw();
                  // }
                  // customize: function ()
                  // {
                  //   window.location.href = "export.php";
                  // }
                  // action: function (e, dt, node, config) {
                  //     $.ajax({
                  //         "url": 'export.php',
                  //         "success": function (res, status, xhr) {
                  //             var csvData = new Blob([res], {type: 'text/csv;charset=utf-8;'});
                  //             var csvURL = window.URL.createObjectURL(csvData);
                  //             var tempLink = document.createElement('a');
                  //             tempLink.href = csvURL;
                  //             tempLink.setAttribute('download', 'data.csv');
                  //             tempLink.click();
                  //         }
                  //     });
                  // }
                  // action: function(e,indicator, dt, button, config) {
                  //     var data = table.rows({search:'applied'}).data().toArray();
                  //     console.log(data);
                  //
                  //     // Add code to make changes to table here
                  //     table.settings().page.len(-1);
                  //     table.settings().drawCallback = function (settings) {
                  //         $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  //     }
                  //     // table.draw();
                  // }
              },
              {
                  extend: 'csv',
                  exportOptions: {
                      columns:[ [0,1], ':visible' ]
                  }
              },
              {
                  extend: 'excel',
                  exportOptions: {
                      columns: [ [0,1], ':visible' ],
                      modifier: {
                          page: 'current'
                      }
                  },
                  customize: function ()
                  {
                      window.location.href = "export.php";
                  }

              },
              {
                  extend: 'pdf',
                  exportOptions: {
                      columns: [ [0,1], ':visible' ]
                  }
              },
              {
                  extend: 'print',
                  exportOptions: {
                      columns: [ [0,1], ':visible' ],
                  },
              },
              // 'copy','csv', 'excel', 'pdf', 'print'
            ],
        'order': [[1,"asc"]],
        'ajax': {
          'url': 'fetch_data.php',
          'type': 'post',
        },
          "columns": [
              {"data": "id"}, //0
              {"data": "name","orderable": true,"sortable":true,"searchable":true}, //0
              {"data": "latitude","orderable": false,"sortable":true}, //2
              {"data": "longitude","orderable": false,"sortable":true}, //2
              {"data": "region","orderable": true,"sortable": true}, //2
              {"data": "subregion","orderable": false,"sortable":true}, //2
          ],
          "language": {
              "processing": "<img src='" + loading + "'/>",
              "paginate": {
                  "first": "<i class='fas fa-angle-double-left'></i>",
                  "previous": "<i class='fas fa-angle-left'></i>",
                  "next": "<i class='fas fa-angle-right'></i>",
                  "last": "<i class='fas fa-angle-double-right'></i>",
              }
          },
        "initComplete": function () {
            // var api = this.api();
            // api.$('td').click( function () {
            //     api.search( this.innerHTML ).draw();
            // } );

            $('#name')
                .on('keyup change', function () {
                        var i = $(this).attr('data-columns');
                        var v = $(this).val();
                        table.columns([i,4]).search(v).draw();
                    }
                );
            $('#region')
                .change(function () {
                        var i = $(this).attr('data-columns');
                        var v = $(this).val();
                        table.columns(i).search(v).draw();
                    }
                );

        }
      });
        table.on('order.dt search.dt', function () {
            table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        });


        $('#min, #max').keyup( function() {
            table.draw();
        } );

        // $('#name').keyup(function () {
        //     table.column($(this).data('columns')).search($(this).val()).draw();
        // })

        $('#column_name').selectpicker();

        $('#column_name').change(function(){
            var all_column = ["0", "1", "2", "3", "4","5"];

            var remove_column = $('#column_name').val();
            var remaining_column = all_column.filter(function(obj) { return remove_column.indexOf(obj) == -1; });

            table.columns(remove_column).visible(false);

            table.columns(remaining_column).visible(true);

        });

    });


  </script>
</body>

</html>
<script type="text/javascript">
  //var table = $('#example').DataTable();
</script>