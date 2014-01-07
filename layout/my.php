<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$hascopyright = (empty($PAGE->theme->settings->copyright)) ? false : $PAGE->theme->settings->copyright;
$hasfootnote = (empty($PAGE->theme->settings->footnote)) ? false : $PAGE->theme->settings->footnote;
$sidebar = "RIGHT";
$regions = bootstrap3_grid();
$PAGE->set_popup_notification_allowed(false);
$PAGE->requires->jquery();
echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<nav role="navigation" class="navbar navbar-default">
    <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#moodle-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $SITE->shortname; ?></a>
    </div>

    <div id="moodle-navbar" class="navbar-collapse collapse">
        <?php echo $OUTPUT->custom_menu(); ?>
        <?php echo $OUTPUT->user_menu(); ?>
        <ul class="nav pull-right">
            <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
        </ul>
    </div>
    </div>
</nav>

<div id="page">
    <header id="page-header" class="clearfix">
        <div id="page-navbar" class="container">
            <div class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></div>
            <nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
        </div>

        <div id="course-header">
            <?php echo $OUTPUT->course_header(); ?>
        </div>
    </header>

    <div id="page-content" class="container">
        <div id="region-main" class="<?php echo $regions['content']; ?>">
        	<div id="heading"><?php echo $OUTPUT->page_heading(); ?></div>
            <?php
            echo $OUTPUT->course_content_header();
            ?>
            
            <div class="block block_dashboardcourses" role="complementary">
				<div class="header">
					<div class="title">
						<?php
						echo '<div id="allcourses" class="btn"><a href="'.$CFG->wwwroot.'/course/">All Courses</a></div>';
   						?>
   						<h2 >My Courses</h2>
					</div>
				</div>
				<div class="content">
					<div class="mycourseboxes">
						<?php
            					echo $OUTPUT->mycourses($CFG,$sidebar);
            				?>
            			</div>
				</div>
			</div>
            
         	 <?php
            echo $OUTPUT->main_content();
            echo $OUTPUT->course_content_footer();
            ?>
        </div>

        <?php
        if ($hassidepost) {
            echo $OUTPUT->blocks('side-post', $regions['post']);
        }?>
    </div>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
<footer id="page-footer">
	<div class="container">
	<div class="row">
		<div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<?php
			echo $OUTPUT->home_link();
			 if ($hascopyright) {
        	echo '<p class="copy">|&nbsp;&nbsp;&nbsp;&copy; '.date("Y").' '.$hascopyright.'</p>';
   			} ?>
		</div>
       		
		<div class="col-lg-6">
       			 <?php
       			 	if ($hasfootnote) {
        			echo $hasfootnote;
   				} ?>
   				<p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
		</div>
       		
		<div class="col-lg-3">
			<?php echo $OUTPUT->login_info(); ?>
		</div>
	</div>
	<?php echo $OUTPUT->standard_footer_html(); ?>
	</div>
</footer>

<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

    $("#b-0").click(function() { NProgress.start(); });
    $("#b-40").click(function() { NProgress.set(0.4); });
    $("#b-inc").click(function() { NProgress.inc(); });
    $("#b-100").click(function() { NProgress.done(); });
</script>
  
</body>
</html>