<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Datatables Serverside Sample</title>

    <!-- CSS for datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  </head>
  <body>
    <p>Although this is presented as a sample, there are no working examples. Implementation with the CI framework, using the instructions provided should be more than sufficient to use the modules properly. As previously stated in the readme file, this will simply act as a guide for future use and easy integration into existing systems (or new ones)</p>

    <table id="sampleTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <th>Transaction ID</th>
        <th>Customer ID</th>
        <th>Customer name</th>
        <th>Date/Time</th>
        <th>Amount</th>
        <th>Status</th>
      </thead>
      <tbody>

      </tbody>
    </table>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Include datatables jabascript -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script type="text/javascript">

      $(document).ready(function(){
        var table = $('#sampleTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax" : {
              "url" : "<?php echo site_url('Sample/datatablesServerSide') ?>",
              "type" : 'POST'
            }
        });

      });

    </script>
  </body>
</html>
