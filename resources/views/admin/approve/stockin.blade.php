@extends('admin.master');

@section('page-title')
    Inventory | StockIn Form
@endsection

@section('content-heading')
    StockIn Form
@endsection

@section('main-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    General Information
                </div>
                @if(Session::get('stockScsMsg'))
                    <div class="alert alert-success">
                    
                        {{ Session::get('stockScsMsg') }}
                    </div>
                @endif
test
                @if(Session::get('stockErrMsg'))
                    <div class="alert alert-danger">
                   
                        {{ Session::get('stockErrMsg') }}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="row">
                        <form role="form" action="{{ url('stockin') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Supplier Name</label>
                                    <select class="form-control" name="supname" required>
                                        <option value="" required>Select</option>
                                        @foreach($registration as $reg)
                                            <option value="{{ $reg->id }}">{{ $reg->name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <a href="{{ url('registration') }}" class="btn btn-primary">+ Add New</a>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="lotname" placeholder="Enter  name"
                                           required>
                                </div>

                            

                                <div class="form-group">
                                    <label>Uniq Tag</label>
                                    <input type="number" class="form-control" name="uniqtag" id="uniqtag" placeholder="Enter no of coil" default>
                                </div>

                                <div class="form-group">
                                    <label>Building</label>
                                        <select class="form-control" name="buildingname" required>
                                            <option value="">-- Select --</option>
                                            @foreach($buildingData as $building)
                                                <option value="{{ $building->id }}" >{{ $building->buildingsname }}</option>
                                            @endforeach
                                        </select>
                                 </div>
                                 <div class="form-group">
                            <label>Category</label>
                                        <select class="form-control" name="categoryid" required>
                                            <option value="">-- Select --</option>
                                            @foreach($categoryData as $category)
                                                <option value="{{  $category->id }}" >{{ $category->categoryname }}</option>
                                            @endforeach
                                        </select>
                                </div>

                            </div>
                            <div class="col-lg-6">
                         

                            
                                <div class="form-group">
                                <label>Sub Category</label>
                                        <select class="form-control" name="subcategoryid" required>
                                            <option value="">-- Select --</option>
                                            @foreach($subcategoryData as $subcategory)
                                                <option value="{{ $subcategory->id }}" >{{ $subcategory->subcategoryname }}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="form-group">
                                <div class="input-group control-group increment" >
                                    <input type="file" class="form-control" name="files[]" multiple>
                                    <div class="input-group-btn"> 
                                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                </div>
                                    <!-- <div class="clone hide">
                                    <div class="control-group input-group" style="margin-top:10px">
                                        <input type="file" class="form-control" name="files[]" multiple>
                                        <div class="input-group-btn"> 
                                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>Remove</button>
                                        </div>
                                    </div>
                                    </div> -->

                                </div>
                                <div class="form-group">
                                    <label>Approval Date</label>
                                    <input type="date" class="form-control" name="approvaldate" id="approvaldate" placeholder="select date" default>
                                </div>
                                <div class="form-group">
                                    <label>Approved By</label>
                                    <input type="text" class="form-control" name="approvedby" id="approvedby" placeholder="approved by" default>
                                </div>
                                <div class="form-group">
                                    <label>Additional Comments</label>
                                    <textarea class="form-control" name="notes" id="notes" placeholder="Additional Comments"></textarea>
                                </div>
                                <!-- <div class="form-group">
                                    <label>No of Coil</label>
                                    <input type="number" class="form-control" name="coil" placeholder="Enter no of coil"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" name="note" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Total Weight</label>
                                <div class="form-group input-group">
                                    <input type="number" id="inputTon" onkeyup="rentCalculation()" class="form-control"
                                           name="tweight" step="any" required>
                                    <span class="input-group-addon">Ton</span>
                                </div>
                                <label>Rent Per Ton</label>
                                <div class="form-group input-group">
                                    <input type="number" id="rent" class="form-control" name="rent" value="400"
                                           step="any"
                                           required>
                                    <span class="input-group-addon">Taka</span>
                                </div>
                                <label>Stock Total Rent</label>
                                <div class="form-group input-group">
                                    <input type="number" id="totalPrice" class="form-control" name="totalrent"
                                           step="any" required>
                                    <span class="input-group-addon">Taka</span>
                                </div>
                                <script>
                                    function rentCalculation() {
                                        var ton = document.getElementById('inputTon').value;
                                        var rent = document.getElementById('rent').value;
                                        document.getElementById('totalPrice').value = ton * rent;
                                    }
                                </script>
                                <label>No of Truck Use</label>
                                <div class="form-group input-group">
                                    <input type="number" class="form-control" name="truck" required>
                                    <!--<span class="input-group-addon">Taka</span>
                                </div> -->
                                <button type="submit" class="btn btn-primary">+ Add New Stock</button>
                            </div>
                        </form>
                        <!-- /.col-lg-6 (nested) -->

                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <script>

$(document).ready(function() {

$(".btn-success").click(function(){ 
    var html = $(".clone").html();
    $(".increment").after(html);
});

$("body").on("click",".btn-danger",function(){ 
    $(this).parents(".control-group").remove();
});

});


                                //unique ID generator
                                function Generator() {};

                                Generator.prototype.rand =  Math.floor(Math.random() * 26) + Date.now();

                                Generator.prototype.getId = function() {
                                return this.rand++;
                                };

                                var idGen =new Generator();
                                document.getElementById('uniqtag').value = idGen.rand;
                                // alert(idGen);
                                // console.log(idGen);
                                </script>
@endsection