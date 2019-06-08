
    <!-- BEGIN PAGE STYLES -->
    <!-- END PAGE STYLES -->        
  
    <!-- BEGIN PAGE CONTAINER -->
    <div class="page-container">
        <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Categories</h1>
                </div>
                <!-- END PAGE TITLE -->			
            </div>
        </div>
        <!-- END PAGE HEAD -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE BREADCRUMB -->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="#">Home</a><i class="fa fa-circle"></i>
                    </li>
                    <li class="active">
                        Categories
                    </li>
                </ul>
                <!-- END PAGE BREADCRUMB -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="row margin-top-10">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Category List</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <button id="sample_editable_1_new" class="btn green">
                                                Add New <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">                                            
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th style="display:none;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($categories as $category){
                                            echo '<tr>';
                                            echo '<td>'.$category['name'].'</td>';
                                            echo '<td><a class="edit" href="javascript:;"> Edit </a></td>';
                                            echo '<td><a class="delete" href="javascript:;"> Delete </a></td>';
                                            echo '<td style="display:none;">'.$category['id'].'</td>';
                                            echo '</tr>';
                                        }
                                    ?>                               
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

    <!-- Begin PAGE LEVEL PLUGINS -->
    <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/category.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
    jQuery(document).ready(function() {    
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        Demo.init(); // init demo(theme settings page)
        TableEditable.init();

        $('#categoryNav').addClass('active');
    });
    </script>
    <!-- END JAVASCRIPTS -->