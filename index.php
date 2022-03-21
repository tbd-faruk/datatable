<?php include('connection.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
<!--  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<!--    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">-->
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
<!--          <div class="col-2">-->
<!--              <div class="form-group">-->
<!--                  <label for="">Min</label>-->
<!--                  <input type="text" id="min" name="min" class="form-control">-->
<!--              </div>-->
<!--          </div><div class="col-2">-->
<!--              <div class="form-group">-->
<!--                  <label for="">Max</label>-->
<!--                  <input type="text" id="max" name="max" class="form-control">-->
<!--              </div>-->
<!--          </div>  -->
<!--      </div>-->
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
      </div>


    <div class="row">
      <div class="container">
<!--        <div class="btnAdd">-->
<!--          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Add User</a>-->
<!--        </div>-->
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="example" class="table">
              <thead>
                <th>Id</th>
                <th>Name</th>
                <th>latitude</th>
                <th>longitude</th>
                <th>region</th>
                <th>subregion</th>
              </thead>
<!--                <tfoot>-->
<!--                <td></td>-->
<!--                <td><input type="text" name="name" id="name" data-columns="1"></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td>-->
<!--                    <select name="region" id="region" data-columns="4" class="form-control">-->
<!--                        <option value="">Please Select</option>-->
<!--                        <option value="Asia">Asia</option>-->
<!--                        <option value="Europe">Europe</option>-->
<!--                        <option value="Polar">Polar</option>-->
<!--                        <option value="Americas">Americas</option>-->
<!--                        <option value="Europe">Europe</option>-->
<!--                        <option value="Oceania">Oceania</option>-->
<!--                    </select>-->
<!--                </td>-->
<!--                <td></td>-->
<!--                </tfoot>-->
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
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
          "lengthMenu": [10, 20, 50, 100, 200, 500],
          "iDisplayLength": 10,
          "processing": true,
          "serverSide": true,
          "paging": true,
          "pagingType": "full_numbers",
          "searching": true,
          "dom": 'lBfrtip',
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
              'copy','csv', 'excel', 'pdf', 'print'
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


        $('#min, #max').keyup( function() {
            table.draw();
        } );

        // $('#name').keyup(function () {
        //     table.column($(this).data('columns')).search($(this).val()).draw();
        // })
    });


  </script>
</body>

</html>
<script type="text/javascript">
  //var table = $('#example').DataTable();
</script>