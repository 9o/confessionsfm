<!doctype html>
<html>
<head>
<title>Confessions.fm | <?php echo $title; ?></title>
<meta charset="utf-8">

<link type="text/css" rel="stylesheet" href="<?php echo base_url().'assests/css/style.css'; ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url().'assests/css/online_web.css'; ?>" />
</head>

<body class="online_web_page">
<div id="container">
	<!-- header starts here -->
	<div class="header">	
		<div class="center clearfix">
			<div class="logo">
				<h1><a href="/">Confession.fm</a></h1>
			</div>
			<!-- /.logo -->
                        <?php $this->load->module('pages');
                              $this->pages->search_field(); ?>
			<!-- /.searchbox -->
			<ul class="hr-nav inline-list">
				<li><a href="/" class="home">Home</a></li>
				
                                    <?php $this->load->module('users');
                              $this->users->login_logout(); ?>

				
			</ul> 
		</div>
	</div>
	<!-- header ends here -->

	<!-- main starts here -->
	<div class="main">
		
		<div class="center clearfix">
			<div class="sidebar sidebar1">
				<?php 
                                $this->users->login_status(); ?>
				<div class="sb-sec sb-sec1">
					<ul class="list-default">
						<li><a href="/"><i class="icon icon-feed"></i> Latest Confessions</a></li>
						<li><a href="/pages/"><i class="icon icon-group"></i> Group Directory</a></li>
					</ul>
				</div>
				<div class="sb-sec sb-sec2">
                                    <?php $this->pages->my_groups(); ?>
				</div>
			</div>
			<!-- /.sidebar1 -->
			<div class="content-area">
				<div class="ca-inner">
					<div class="posts">
						<!-- /.post -->
                                                <?php $this->load->view($module.'/'.$view_file) ?>
						<!-- /.post -->
					</div>
				</div>
			</div>
			<!-- /.content-area -->
			<div class="sidebar sidebar2 footer">
				<p>Confessions.fm &copy; 2013</p>
				<p>
					<a href="/statics/privacy_policy"><span>Privacy</span></a> . 
					<a href="/statics/terms"><span>Terms</span></a>

				</p>
			</div>
		</div>

	</div>
	<!-- Main ends here -->

</div><!-- container ends here -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url().'assests/js/moment.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assests/js/livestamp.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assests/js/main.js'; ?>" type="text/javascript"></script>
<script src="//static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try{ clicky.init(100681706); }catch(e){}</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100681706ns.gif" /></p></noscript>
</body>
</html>