<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="main-content container">
<div class="dashboard">
	<div class="row">
		<div class="col col-md-3">
			<!-- Profile Div -->
			<div class="sidebar">
				<!-- WedBox Profile box -->
				<div class="wedbox profile-box" id="profile-box">
					<div role="presentation" class="dropdown profile-photo">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<img class="img-responsive" src="../img/profile-cover.png" alt="">
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li>Logged in as <h4>First name Last Name</h4></li>
							<li></li>
							<li><a class="btn btn-primary center-block" href="profile.html">Profile Update</a></li>
							
							<li><a class="btn btn-primary center-block" href="logout.html">Logout</a></li>
						</ul>
					</div>
					<span class="badge">
						<h5>268</h5>
						<span>days</span>
					</span>
					<div class="wedbox-content">
						<div class="row">
							<div class="col-md-12 content-wrapper">
								<div class="widget-listings">
									<div class="listing couple-name">
										Samir &amp; Maya
									</div>
									<div class="listing wedding-type">
										Civil Marriage
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="wedbox-title">
						<h5>Wedding Date</h5>
					</div>
					<div class="wedbox-content">
						<div class="row">
							<div class="col-md-12 content-wrapper">
								<div class="widget-listings">
									<div class="listing">
										<!-- <input type="date" class="form-control wedding-form-control" id="fromDate" data-placeholder="" required aria-required="true"> -->
										<!-- <input class="form-control" type="text" name="daterange" value=""> -->
										<div class="wedding-daterange">
											<input type="text" id="wedding-daterange-1" name="daterange" value="12/25/2016 - 12/25/2017" class="form-control wed-drp">
											<i class="fa fa-th"></i>
										</div>
									</div>
									<!-- <div class="listing text-center">
											<a href="#">+ Add Date Range</a>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- WedBox News box -->
				<div class="wedbox news-box" id="news-box">
					<div class="wedbox-title">
						<span class="icon"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></span>
						<h5>News, Tips And Advice</h5>
					</div>
					<div class="wedbox-content">
						<div class="row">
							<div class="col-md-12 content-wrapper">
								<div class="widget-listing">
									<div class="listing">
										<a href="#" class="pull-left">
											<img src="../img/img-news-1.png" alt="">
										</a>
										<div class="news-body">
											<p>5 things to consider when setting your budget</p>
											<a href="">Read More...</a>
										</div>
									</div>
									<div class="listing">
										<a href="#" class="pull-left">
											<img src="../img/img-news-2.png" alt="">
										</a>
										<div class="news-body">
											<p>Wedding dress trends for 2017</p>
											<a href="">Read More...</a>
										</div>
									</div>
									<div class="listing">
										<a href="#" class="pull-left">
											<img src="../img/img-news-3.png" alt="">
										</a>
										<div class="news-body">
											<p>7 things you need to avoid</p>
											<a href="">Read More...</a>
										</div>
									</div>
									<div class="wedbox-nav">
										<a href="" class="pull-left">View More</a>
										<a href="" class="pull-right">Add Your Own</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- WedBox Showcase box -->
				<div class="wedbox news-box showcase-box" id="showcase-box">
					<div class="wedbox-title">
						<span class="icon"><i class="fa fa-video-camera" aria-hidden="true"></i></span>
						<h5>Weddings Showcase</h5>
					</div>
					<div class="wedbox-content">
						<div class="row">
							<div class="col-md-12 content-wrapper">
								<div class="widget-listing">
									<div class="listing">
										<a href="#" class="pull-left">
											<img src="../img/img-wedding-showcase.png" alt="">
										</a>
										<div class="news-body">
											<a>Blue Themed Wedding</a>
										</div>
									</div>
									<div class="listing">
										<a href="#" class="pull-left">
											<img src="../img/img-wedding-showcase.png" alt="">
										</a>
										<div class="news-body">
											<a>Luxury Royal Wedding</a>
										</div>
									</div>
									<div class="listing">
										<a href="#" class="pull-left">
											<img src="../img/img-wedding-showcase.png" alt="">
										</a>
										<div class="news-body">
											<a>Wedding at the beach</a>
										</div>
									</div>
									<div class="wedbox-nav">
										<a href="" class="pull-left">View More</a>
										<a href="" class="pull-right">Add Your Own</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col col-md-9">
			<div class="row content">
				<div class="col-md-6">
					<!-- WedBox planning box -->
					<div class="wedbox" id="planning-box">
						<div class="wedbox-title">
							<span class="icon"><i class="fa fa-check-square-o" aria-hidden="true"></i></span>
							<h5>Planning</h5>
							<div class="wedbox-tools">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
						<div class="wedbox-content">
							<div class="row">
								<div class="col-md-12 content-wrapper">
									<div class="pull-right widget-image">
										<img src="../img/img-planning.png" alt="">
									</div>
									<div class="pull-left widget-listings">
										<div class="listing">
											<small>Late Tasks</small>
											<h2>3</h2>
										</div>
										<div class="listing">
											<small>To Do</small>
											<h2>25</h2>
										</div>
										<div class="listing">
											<small>Done</small>
											<h2>14</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- WedBox budget box -->
					<div class="wedbox" id="budget-box">
						<div class="wedbox-title">
							<span class="icon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
							<h5>Budget &amp; Finance</h5>
							<div class="wedbox-tools">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
						<div class="wedbox-content">
							<div class="row">
								<div class="col-md-12 content-wrapper">
									<div class="pull-right widget-image">
										<img src="../img/img-budget.png" alt="">
									</div>
									<div class="pull-left widget-listings">
										<div class="listing">
											<small>Budgeted</small>
											<h2>$40,000</h2>
										</div>
										<div class="listing">
											<small>Financed</small>
											<h2>$20,000</h2>
										</div>
										<div class="listing">
											<small>Spent</small>
											<h2>$3,000</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			
			<div class="row content squeezed">
				<div class="col-md-12">
					<!-- WedBox catalog box -->
					<div class="wedbox" id="catalog-box">
						<div class="wedbox-title">
							<span class="icon"><i class="fa fa-book" aria-hidden="true"></i></span>
							<h5>Catalog of Services</h5>
							<div class="wedbox-tools">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
						<div class="row features catalog">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<div class="feature-container">
									<div class="carousel-container">
										<div class="left nav-control prev-nav">
											<a class="btn btn-primary prev">
												<i class="fa fa-chevron-left" aria-hidden="true"></i>
											</a>
										</div>
										<div class="right nav-control next-nav">
											<a class="btn btn-primary next">
												<i class="fa fa-chevron-right" aria-hidden="true"></i>
											</a>
										</div>
										<div id="owl-catalog-session" class="carousel owl-carousel owl-theme compact">
											<a href="#">
												<div class="item">
													<h4 class="title">Makeup</h4>
													<img src="../img/img-makeup.png" alt="">
												</div>
											</a>
											<a href="#">
												<div class="item">
													<h4 class="title">Hairdressing</h4>
													<img src="../img/img-hair.png" alt="">
												</div>
											</a>
											<a href="#">
												<div class="item">
													<h4 class="title">Car rental</h4>
													<img src="../img/img-makeup.png" alt="">
												</div>
											</a>
											<a href="#">
												<div class="item">
													<h4 class="title">Makeup</h4>
													<img src="../img/img-makeup.png" alt="">
												</div>
											</a>
											<a href="#">
												<div class="item">
													<h4 class="title">Hairdressing</h4>
													<img src="../img/img-hair.png" alt="">
												</div>
											</a>
											<a href="#">
												<div class="item">
													<h4 class="title">Car rental</h4>
													<img src="../img/img-makeup.png" alt="">
												</div>
											</a>
											<a href="#">
												<div class="item">
													<h4 class="title">Makeup</h4>
													<img src="../img/img-makeup.png" alt="">
												</div>
											</a>
											<a href="#">
												<div class="item">
													<h4 class="title">Hairdressing</h4>
													<img src="../img/img-hair.png" alt="">
												</div>
											</a>
											<a href="#">
												<div class="item">
													<h4 class="title">Car rental</h4>
													<img src="../img/img-makeup.png" alt="">
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
				
			<div class="row content">
				<div class="col-md-6">
					<!-- WedBox invitations box -->
					<div class="wedbox" id="invitations-box">
						<div class="wedbox-title">
							<span class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
							<h5>Invitations</h5>
							<div class="wedbox-tools">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
						<div class="wedbox-content">
							<div class="row">
								<div class="col-md-12 content-wrapper">
									<div class="pull-right widget-image">
										<img src="../img/img-card.png" alt="">
									</div>
									<div class="pull-left widget-listings">
										<div class="listing">
											<small>Cards Desgined</small>
											<h2>Yes</h2>
										</div>
										<div class="listing">
											<small>Invitees</small>
											<h2>521</h2>
										</div>
										<div class="listing">
											<small>Seated</small>
											<h2>521</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- WedBox website box -->
					<div class="wedbox" id="website-box">
						<div class="wedbox-title">
							<span class="icon"><i class="fa fa-mouse-pointer" aria-hidden="true"></i></span>
							<h5>Website</h5>
							<div class="wedbox-tools">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
						<div class="wedbox-content">
							<div class="row">
								<div class="col-md-12 content-wrapper">
									<div class="pull-right widget-image">
										<img src="../img/img-website.png" alt="">
									</div>
									<div class="pull-left widget-listings">
										<div class="listing">
											<small>Status</small>
											<h2>Done</h2>
										</div>
										<div class="listing last">
											<small>URL</small>
											<h2 class="long-value">SamirMayaWedding.Com</h2>
										</div>
										<div class="listing"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row content squeezed">
				<div class="col-md-12">
					<div class="feature-container">
						<img src="../img/72890-ad-grey.png" alt="728 x 90 Advertising" width="728" height="90" class="img-rounded img-responsive center-block">
					</div>
				</div>
			</div>
			<div class="row content">
				<div class="col-md-6">
					<!-- WedBox honeymoon box -->
					<div class="wedbox" id="honeymoon-box">
						<div class="wedbox-title">
							<span class="icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
							<h5>Honeymoon</h5>
							<div class="wedbox-tools">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
						<div class="wedbox-content">
							<div class="row">
								<div class="col-md-12 content-wrapper">
									<div class="pull-right widget-image">
										<img src="../img/img-honeymoon.png" alt="">
									</div>
									<div class="pull-left widget-listings">
										<div class="listing">
											<small>Status</small>
											<h2>Booked</h2>
										</div>
										<div class="listing">
											<small>Destination</small>
											<h2>Maldives</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- WedBox offers box -->
					<div class="wedbox" id="offers-box">
						<div class="wedbox-title">
							<span class="icon"><i class="fa fa-percent" aria-hidden="true"></i></span>
							<h5>Packages &amp; Offers</h5>
							<div class="wedbox-tools">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
						<div class="wedbox-content">
							<div class="row">
								<div class="col-md-12 content-wrapper">
									<div class="widget-image">
										<img src="../img/img-offers.png" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    </div>
