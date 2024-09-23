<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Server Side Datatable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-xs-12">
                <table class = "table table-striped datatable" id ="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


<script>
    // Datatable server side rendering
    $(document).ready( function () {
        $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            stateSave: true,
            "ajax":{
                'url': "<?=site_url();?>/api/users/getAll",
                "method": "POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" }
            ]
        });
    } );
</script>
</html>