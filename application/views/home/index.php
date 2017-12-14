<div id="outer_header">
    <div id="header"> 
        <div id="right_header">
            <div class="top_nav">
                <ul>
                    <li><a href="#" class="active"><span>Downloads</span></a></li>
                    <li><a href="#"><span>Libraries</span></a></li>
                    <li><a href="#"><span>Maps</span></a></li>
                    <li><a href="#"><span>FAQ's</span></a></li>
                    <li><a href="#"><span>Site map</span></a></li>
                    <li><a href="#"><span>Media</span></a></li>
                    <li>
							<?php if (isset($current_user->email)) : ?>
								<a href="<?php echo site_url(SITE_AREA) ?>"><span>Admin area</span></a>
							<?php else :?>
								<a href="<?php echo site_url(LOGIN_URL); ?>"><span><?php echo lang('bf_action_login'); ?></span></a>
							<?php endif;?>
						</li>
                </ul>
            </div>

            <div class="search"> <span>
                <input type="text" onblur="if(this.value == '') { this.value = 'Enter a keyword'; }" onfocus="if(this.value == 'Enter a keyword') { this.value = ''; }" value="Enter a keyword" />
                <a href="#">Search</a></span> </div>
        </div>
<div id="nav">
    <?php echo theme_view('_sitenav'); ?>
</div>
    </div>
    <br class="clear" />
</div>
<div id="outer_banner">
    <div id="outer_banner_second">
        <div id="banner">
            <div id="banner_wrapp">
                <div id="banner_slider">
                
                 <div id="banner_images"><img src="images/banner1.jpg" alt="" /><img src="images/banner2.jpg" alt="" /><img src="images/banner3.jpg" alt="" /><img src="images/banner4.jpg" alt="" /><img src="images/banner5.jpg" alt="" /><img src="images/banner6.jpg" alt="" /> </div>
                 <div id="pager"></div>
                 </div>
            </div>
            <div id="typo">
                <blockquote>
                    <p>&ldquo;Art washes away from the soul the dust of everyday life.&rdquo;</p>
                </blockquote>
                <span> Pablo Picasso 1881-1973</span> </div>
        </div>
    </div>
</div>
<div id="outer_news">
    <div id="news_scroller">
        <div class="news_box">
            <h3>Latest News</h3>
            <div class="news_scroll">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra lorem nec sapien dapibus gravida.</p>
            </div>
        </div>
        <span class="apply_now"><a href="#">Mahasiswa Baru</a></span> <br class="clear" />
    </div>
</div>
<div id="outer_content">
    <div id="content">
        <div class="latest_courses">
            <h2>Our Latest Courses</h2>
            <div class="text_course">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra lorem nec sapien dapibus gravida. Curabitur in aliquam nulla. Mauris eget orci eget nibh elementum convallis. Nullam rhoncus ipsum ut lorem vulputate sed adipiscing odio ornare.</p>
            </div>
        </div>
        <div class="design_category">
            <div class="category_box">
                <div class="category_inner"><a href="#"> <img src="images/img-c1.jpg" alt="" /> </a>
                    <div class="toggle_category">
                        <h2>Schulpture Designs</h2>
                        <div class="toggle_text">
                            <p>Lorem ipsum dolor sit amet, sectetur adipiscing elit. Donecnectyfdss sapien dapibus gravida. Lorem ipsum dolor sit ametgravida.</p>
                        </div>
                    </div>
                </div>
                <span class="imgbottom"></span> </div>
            <div class="category_box">
                <div class="category_inner"><a href="#"> <img src="images/img-c2.jpg" alt="" /> </a>
                    <div class="toggle_category">
                        <h2>Interior Designing</h2>
                        <div class="toggle_text">
                            <p>Lorem ipsum dolor sit amet, sectetur adipiscing elit. Donecnectyfdss sapien dapibus gravida. Lorem ipsum dolor sit ametgravida.</p>
                        </div>
                    </div>
                </div>
                <span class="imgbottom"></span> </div>
            <div class="category_box">
                <div class="category_inner"><a href="#"> <img src="images/img-c3.jpg" alt="" /> </a>
                    <div class="toggle_category">
                        <h2>Painting and Scathing</h2>
                        <div class="toggle_text">
                            <p>Lorem ipsum dolor sit amet, sectetur adipiscing elit. Donecnectyfdss sapien dapibus gravida. Lorem ipsum dolor sit ametgravida.</p>
                        </div>
                    </div>
                </div>
                <span class="imgbottom"></span> </div>
            <div class="category_box">
                <div class="category_inner"><a href="#"> <img src="images/img-c4.jpg" alt="" /> </a>
                    <div class="toggle_category">
                        <h2>Graphics Designing</h2>
                        <div class="toggle_text">
                            <p>Lorem ipsum dolor sit amet, sectetur adipiscing elit. Donecnectyfdss sapien dapibus gravida. Lorem ipsum dolor sit ametgravida.</p>
                        </div>
                    </div>
                </div>
                <span class="imgbottom"></span> </div>
        </div>
        <div class="col_home">
            <div class="col_left">
                <div class="nav_news">
                    <ul>
                        <li class="active"><a href="#tab1">Latest News</a></li>
                        <li><a href="#tab2">Latest Blog</a></li>
                    </ul>
                </div>
                <div class="content_news" id="tab1">
                    <ul>
                        <li> <img src="images/img-n1.jpg" alt="" />
                            <div class="news_desc">
                                <h3>College Annual Examination</h3>
                                <h4>Posted by <a href="#">Kyle</a> on <strong>February 2nd, 2011</strong></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec adipiscing justo :: <a href="#">Read More</a></p>
                            </div>
                        </li>
                        <li> <img src="images/img-n2.jpg" alt="" />
                            <div class="news_desc">
                                <h3>College Annual Examination</h3>
                                <h4>Posted by <a href="#">Kyle</a> on <strong>February 2nd, 2011</strong></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec adipiscing justo :: <a href="#">Read More</a></p>
                            </div>
                        </li>
                        <li> <img src="images/img-n3.jpg" alt="" />
                            <div class="news_desc">
                                <h3>College Annual Examination</h3>
                                <h4>Posted by <a href="#">Kyle</a> on <strong>February 2nd, 2011</strong></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec adipiscing justo :: <a href="#">Read More</a></p>
                            </div>
                        </li>
                    </ul>
                    <div class="more_links"> <a href="#">Go to News Page &gt;&gt;</a> </div>
                </div>
                <div class="content_news" id="tab2">
                    <ul>
                        <li> <img src="images/img-n1.jpg" alt="" />
                            <div class="news_desc">
                                <h3>College Annual Examination</h3>
                                <h4>Posted by <a href="#">Kyle</a> on <strong>February 2nd, 2011</strong></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec adipiscing justo :: <a href="#">Read More</a></p>
                            </div>
                        </li>
                        <li> <img src="images/img-n2.jpg" alt="" />
                            <div class="news_desc">
                                <h3>College Annual Examination</h3>
                                <h4>Posted by <a href="#">Kyle</a> on <strong>February 2nd, 2011</strong></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec adipiscing justo :: <a href="#">Read More</a></p>
                            </div>
                        </li>
                        <li> <img src="images/img-n3.jpg" alt="" />
                            <div class="news_desc">
                                <h3>College Annual Examination</h3>
                                <h4>Posted by <a href="#">Kyle</a> on <strong>February 2nd, 2011</strong></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec adipiscing justo :: <a href="#">Read More</a></p>
                            </div>
                        </li>
                    </ul>
                    <div class="more_links"> <a href="#">Go to News Page &gt;&gt;</a> </div>
                </div>
            </div>
            <div class="col_middle">
                <div class="search_course">
                    <div class="heading_content">
                        <h2>Search Courses</h2>
                    </div>
                    <div class="search_box_course">
                        <p><a href="#">Our courses</a> are applied,innovative and grounded in the real world.</p>
                        <span class="search_field">
                        <input type="text" onblur="if(this.value == '') { this.value = 'Enter a keyword'; }" onfocus="if(this.value == 'Enter a keyword') { this.value = ''; }" value="Enter a keyword" />
                        <a href="#">Search</a> </span>
                        <div class="option_search">
                            <ul>
                                <li><a href="#">Advance Option</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">A to Z Courses</a></li>
                                <li><a href="#">Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="top_courses">
                    <div class="img_course"> <img src="images/img-course.jpg" alt="" /> <span>Top Course</span> </div>
                    <div class="course_info">
                        <div class="course_text">
                            <h3>2 years Diploma in fine arts</h3>
                            <h5>Lorum ipsum dolor summit</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec adipiscing justo non magna luctus a congue magna iaculis. Suspendisse potenti. Curabitur eu tortor ma</p>
                        </div>
                        <a href="#" class="btn_applynow_course"><img src="images/btn-applynow-course.png" alt="" /></a> </div>
                </div>
            </div>
            <div class="col_right"> <a href="#"><img src="images/banner-joinus.jpg" alt="" /></a> </div>
        </div>
        <br class="clear" />
    </div>
</div>