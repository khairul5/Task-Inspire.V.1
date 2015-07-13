<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html lang="en">
<head>

    <link rel="icon" href="<?php echo base_url("files/images"); ?>/favicon.png" type="image/png" sizes="16x16">
    
    <!-- stylesheets -->

 	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css"href="<?php echo base_url('/files/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('material'); ?>/dist/css/roboto.min.css" rel="stylesheet">
    <link href="<?php echo base_url('material'); ?>/dist/css/material-fullpalette.css" rel="stylesheet">
    <link href="<?php echo base_url('material'); ?>/dist/css/ripples.min.css" rel="stylesheet">
    <link href="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"href="https://cdnjs.com/libraries/bootstrap-material-design">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/files/css/custom.css'); ?>">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">




		<!-- javascript -->
	<script src="<?php echo base_url('bootstrap/js/bootstrap.js'); ?>"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<!-- For Date time picker -->

	
    <style>html { font-size: 12px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.429/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.429/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.429/styles/kendo.dataviz.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.429/styles/kendo.dataviz.material.min.css" />

    <script src="http://cdn.kendostatic.com/2015.1.429/js/jquery.min.js"></script>
    <script src="http://cdn.kendostatic.com/2015.1.429/js/kendo.all.min.js"></script>





	<script type="text/javascript">
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});

	</script>


	<!-- Script for Project view -->
	<script type="text/javascript">
	$(document).ready(function(){
	    $(".checkbox").on("change", function(){
	        $("#submit_task").submit();
	    });
	});
	</script>
	
</head>

<body>

    
        
        <header>
         	

            <!-- Logo -->
            <div class="container">
               


         	    <div class="row">
                    <div class="col-lg-12">
                    <div class="bs-component">
                            <div class="navbar navbar-default">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a href="<?php echo base_url().'main/projects'?>"><img src="<?php echo base_url(); ?>/files/images/logo.png" class="head_img"></a>
                                </div>


                                <div class="navbar-collapse navbar-responsive-collapse collapse" aria-expanded="false" style="height: 1px;">
                                   <?php
					                if($this->session->is_logged_in == 1)
					                {
                                    
                                    echo '<ul class="nav navbar-nav navbar-right">';
                                        
                                        echo '<li class="dropdown">';
                                            
                                        	echo '<a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-user"></i> Hello '.$this->session->name.' <span class="caret"></span> <div class="ripple-wrapper"></div></a>';
                                            
                                            echo '<ul class="dropdown-menu">';
                                            	if ($this->session->is_admin==1)
			                            {			                            	
			                            	echo '<li><a class="dropdown_padding" href='.base_url().'main/admin>Permissions</a></li>';
			                            	
			                            }
                                                echo '<li><a class="dropdown_padding" href= '.base_url().'main/profile>Profile</a></li>';
			                           
			                            echo '<li><a class="dropdown_padding" href= '.base_url().'main/logout>Logout</a></li>';
			                      echo '</ul>';
			                    echo '</li>';


                                    echo '</ul>';
                                echo '</div>';
                                 }

	               				 ?> 

                            </div>
                        </div>
                    </div>
                </div>






                <!--Test -->




         	</div>
        	
        </header>

