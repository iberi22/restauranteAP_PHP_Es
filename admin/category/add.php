
<?php
     if (!isset($_SESSION['ADMIN_USERID'])){
      redirect("../admin/index.php");
     }

?>
 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

           <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Add New Category</h1>
          </div>
          <!-- /.col-lg-12 -->
       </div>
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "CATEGORY">Category:</label>

                      <div class="col-md-8">
                         <input class="form-control input-lg" id="CATEGORY" name="CATEGORY" placeholder=
                            "New Category Name..." type="text" value="" required>
                      </div>
                    </div>
                  </div>



             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                         <button style="width: 100%;" class="btn btn-primary btn-lg" name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
                      <!-- <a href="index.php" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->

                     </div>
                    </div>
                  </div>

        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-6 control-label" for=
                    "otherperson"></label>

                    <div class="col-md-6">

                    </div>
                  </div>

                  <div class="col-md-6" align="right">


                   </div>

              </div>
              </div>

        </form>

