<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>


<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<!-- Data Table scripts -->
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script> 

<!--JS for displaying data from "PROCESS" edit pop up modal-->
<script>
    $(document).ready(function () {

        $('.edit_btn').on('click', function () {

            $('#editProcessModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#edit_ID').val(data[0]);
            $('#o_ID').val(data[1]);
            $('#edit_Process_Name').val(data[2]);
            $('#edit_Process_Description').val(data[3]);
            $('#edit_Process_Type').val(data[4]);
        });
    });
</script>

<!--JS for Warning Deleting data from "PROCESS" Delete pop up modal-->
<script>
    $(document).ready(function () {

        $('.delete_btn').on('click', function () {

            $('#deleteProcessModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#delete_ID').val(data[0]); //Hindi sya galing sa database pero lahat ng attributes sa database dito maiistore


        });
    });

    
</script>

<!--JS for displaying data from "Manage Users" edit pop up modal-->
<script>
    $(document).ready(function () {

        $('.edit_btn').on('click', function () {

            $('#editManageUsersModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#edit_ID').val(data[0]); //Hindi sya galing sa database pero lahat ng attributes sa database dito maiistore
            $('#edit_First_Name').val(data[1]);
            $('#edit_Last_Name').val(data[2]);
            $('#edit_Email').val(data[3]);
            $('#edit_User_Type').val(data[4]);
            $('#edit_Sector').val(data[5]);
            $('#edit_Office').val(data[6]);
            $('#edit_Process').val(data[7]);
           // $('#edit_process').val(data[7]);

        });
    });

    
</script>

<!--JS for Warning Deleting data from "Manage Users" Delete pop up modal-->
<script>
    $(document).ready(function () {

        $('.delete_btn').on('click', function () {

            $('#deleteManageUsersModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#delete_ID').val(data[0]); //Hindi sya galing sa database pero lahat ng attributes sa database dito maiistore


        });
    });

    
</script>

<!--JS for displaying data from "Sectors" edit pop up modal-->
<script> 
    $(document).ready(function () {

        $('.edit_btn').on('click', function () {

            $('#editSectorModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#edit_ID').val(data[0]);
            $('#edit_Sector_Name').val(data[1]);
            $('#edit_Sector_Description').val(data[2]);
            $('#edit_Sector_Head').val(data[3]);
        });
    });

    
</script>

<!--JS for Warning Deleting data from "Sectors" Delete pop up modal-->
<script>
    $(document).ready(function () {

        $('.delete_btn').on('click', function () {

            $('#deleteSectorsModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#delete_ID').val(data[0]); //Hindi sya galing sa database pero lahat ng attributes sa database dito maiistore


        });
    });

    
</script>

<!--JS for displaying data from "Offices" edit pop up modal-->
<script> 
    $(document).ready(function () {

        $('.edit_btn').on('click', function () {

            $('#editOfficeModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text().trim(); //Gumamit .trim() para mawala ung space sa modal
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#edit_ID').val(data[0]);
            $('#S_ID').val(data[1]);
            $('#edit_Office_Name').val(data[2]);
            $('#edit_Office_Description').val(data[3]);
            $('#edit_Office_Head').val(data[4]);
        });
    });
</script>

<!--JS for Warning Deleting data from "Offices" Delete pop up modal-->
<script>
    $(document).ready(function () {

        $('.delete_btn').on('click', function () {

            $('#deleteOfficesModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#delete_ID').val(data[0]); //Hindi sya galing sa database pero lahat ng attributes sa database dito maiistore


        });
    });

    
</script>

<!--JS for displaying data from "Manage Documents" edit pop up modal-->
<script> 
    $(document).ready(function () {

        $('.edit_btn').on('click', function () {

            $('#editManageDocumentsModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#edit_ID').val(data[0]);
            $('#edit_Document').val(data[3]); //2 dahil pang 3rd column sa manage documents
        });
    });
</script>

<!--JS for Warning Deleting data from "Manage Users" Delete pop up modal-->
<script>
    $(document).ready(function () {

        $('.delete_btn').on('click', function () {

            $('#deleteDocumentModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            //ID attribute ang kinukuha
            $('#delete_ID').val(data[0]); //Hindi sya galing sa database pero lahat ng attributes sa database dito maiistore


        });
    });

</script>

<!--Data Tales/Pagination and Search -->
<script>
$(document).ready(function () {
    $('#dataTableID').DataTable();
});
</script>



