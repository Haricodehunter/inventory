<!DOCTYPE html>
<html>
 <head>
  <title>Import Excel File </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.full.min.js"></script>
  <script src="https://cdn.datatables.net/u/bs/jq-2.2.3,dt-1.10.12,fc-3.2.2,fh-3.1.2,r-2.1.0,sc-1.4.2/datatables.min.js"></script>
 </head>
 <body>
  <br />

  <!-- <div class="container">
   <h3 align="center">Import Excel File</h3>
    <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif

   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Select File for Upload</label></td>
       <td width="30">
        <input type="file" name="import_file" />
       </td>
       <td width="30%" align="left">
        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">.xls, .xslx</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form> -->

   <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
   {{ csrf_field() }}
        <input type="hidden" id="jsonvalue" name="jsonvalue" value="">
    <td width="30%" align="left">
        <input type="submit" name="upload" class="btn btn-primary" value="Confirm and Upload">
    </td>
   </form>
   <div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4 class="text-center">
        Emport excel data
      <h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form class="form-horizontal">
        <div class="form-group">
          <div clss="col-md-12">
            <input id="inputFile" type="file" class="form-control">
          </div>
        </div>
      </form>
    </div>
  </div>
      <div class="row">
        <div id="workbookContainer" class="col-md-12">



        </div>
      </div>
</div>
   <br />

   <div id="jsonhtml">

   </div>
   <!-- <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Customer Data</h3>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
       <th>Sid</th>
        <th>Name</th>
        <th>categoryid</th>
        <th>subcategoryid</th>
        <th>Approveby</th>
        <th>Approvedate</th>
        <th>Uniqtag</th>
        <th>Building Name</th>
        <th>Image</th>
        <th>Note</th>
       </tr>
       @foreach($result as $row)
       <tr>
       <td>{{ $row->id }}</td>
        <td>{{ $row->lotname }}</td>
        <td>{{ $row->categoryid }}</td>
        <td>{{ $row->subcategoryid}}</td>
        <td>{{ $row->approvedby }}</td>
        <td>{{ $row->approvaldate }}</td>
        <td>{{ $row->uniqtag }}</td>
        <td>{{ $row->buildingname }}</td>
        <td>{{ $row->image }}</td>
        <td>{{ $row->note }}</td>
       </tr>
       @endforeach
      </table>
     </div>
    </div>
   </div>
  </div> -->


  <script>
  $(document).ready(function() {
  function toJSON(workbook) {
    var result = {};
    workbook.SheetNames.forEach(function(sheetName) {
      var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
      if (roa.length > 0) {
        result[sheetName] = roa;
      }
    });
    return result;
  };

  function displayJSON(json) {

    var tabs = $("<ul/>").addClass("nav nav-tabs");

    var tabContents = $("<div/>").addClass("tab-content");

    var first = true;

    for (prop in json) {

      var tab = $("<li/>").append($("<a/>").attr("href", "#" + prop).attr("data-toggle", "tab").html(prop));

      var tabContent = $("<div/>").addClass("tab-pane").attr("id", prop).append($("<table/>").attr("id", prop + "_table").addClass("table table-stripped table-hover"));

      if (first) {
        tab.addClass("active");
        tabContent.addClass("active");
        first = false;
      }

      tabs.append(tab);

      tabContents.append(tabContent);
    }

    $("#workbookContainer").empty();

    $("#workbookContainer").append(tabs);

    $("#workbookContainer").append(tabContents);

    for (prop in json) {
      var columns = [];

      for (column in json[prop][0]) {
        columns.push({
          title: column,
          data: column,
          defaultContent: '<i style="color: red;">Data Missing</i>'
        });
      }

      $("#" + prop + "_table").DataTable({
        bSort: false,
        data: json[prop],
        columns: columns,
        responsive: true
      });
    }

  };

  if (window.File && window.FileList && window.FileReader && window.Blob) {

    $("#inputFile").on("change", function(e) {
      var inputFile = e.target.files[0];

      var fileReader = new FileReader();

      fileReader.onload = function(e) {
        var data = e.target.result;
        var workbook = XLSX.read(data, {
          type: 'binary'
        });

        var jsonData = toJSON(workbook);

        $("#jsonvalue").val(JSON.stringify(jsonData['Sheet1']));
        $("#jsonhtml").html(jsonData['Sheet1']);
        displayJSON(jsonData);

      };

      fileReader.readAsBinaryString(inputFile);

    });
  } else {
    alert("HTML 5 File API not supportedd");
  }

});
</script>
 </body>
</html>


