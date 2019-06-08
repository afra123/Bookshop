
    <!-- BEGIN PAGE STYLES -->
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE STYLES -->        
  
    <!-- BEGIN PAGE CONTAINER -->
    <div class="page-container">
        <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Books</h1>
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
                        <a href="<?php echo base_url(); ?>book">Home</a><i class="fa fa-circle"></i>
                    </li>
                    <li class="active">
                        <a href="<?php echo base_url(); ?>book">Book</a><i class="fa fa-circle"></i>
                    </li>
                    <li>
                        Detail  
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
                                    <i class="fa fa-gift"></i>Book Detail
                                </div>
                                <div class="tools">  
                                    <p style="color:red">
                                    <?php
                                    if($stats > 0){
                                        echo 'Visiter View '.$stats.'  /  Total View '.$total;                                    }
                                    ?>
                                    </p>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?php echo base_url();?>admin/book/saveBook" method="post" class="form-horizontal myForm" enctype="multipart/form-data">   
                                    <input type="hidden" value="<?php echo $bookId; ?>" name="bookId" id="bookId"/>
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        <span>
                                        Fill out the forms. </span>
                                    </div>                                 
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Title</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="Enter Book Title" name="bookTitle" value="<?php echo $book !== null? $book['title']:'';?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Category</label>
                                            <div class="col-md-4">
                                                <select class="form-control input-medium select2me" data-placeholder="Select..." name="categoryId">                                                   
                                                    <option value=""></option>
                                                    <?php
                                                        
                                                        $categoryId = $book !== null? $book['category']:-1;
                                                        foreach($categories as $category){
                                                            $selected = $category['id'] == $categoryId ? 'selected' : '';
                                                            echo '<option value="'.$category['id'].'" '.$selected.'>'.$category['name'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Author</label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Author Name" name="author" value="<?php echo $book !== null? $book['author']:'';?>"/>
                                                    <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Description</label>
                                            <div class="col-md-4">
                                                <textarea class="form-control" rows="3" name="description"><?php echo $book !== null? $book['description']:'';?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Cover</label>
                                            <div class="col-md-4">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="<?php echo base_url(); ?><?php echo $book !== null? $book['coverImg']:'assets/admin/layout/img/noimage.png';?>" alt=""/>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                    </div>
                                                    <div>
                                                        <span class="btn default btn-file">
                                                        <span class="fileinput-new">
                                                        Select image </span>
                                                        <span class="fileinput-exists">
                                                        Change </span>
                                                        <input type="file" name="fileToUpload" value="<?php echo $book !== null? $book['coverImg']:'';?>" id="file">
                                                        </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions fluid">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Save</button>
                                                <a type="button" class="btn default" href="<?php echo base_url();?>admin/book">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
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
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/editBook.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
    jQuery(document).ready(function() {    
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        Demo.init(); // init demo(theme settings page)
        Form.init();

        $('#bookNav').addClass('active');
    });
    </script>
    <!-- END JAVASCRIPTS -->