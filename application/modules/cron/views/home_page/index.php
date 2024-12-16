
<!-- Carousel
    ================================================== -->
<div id="0" class="carousel slide" data-ride="carousel"> 
  <div class="carousel-inner carousel-load" role="listbox">
    <div class="item active"> <img class="first-slide" src="<?php echo base_url()?>assets/front/images/slide-1.jpg" alt="First slide">
      <div class="container">
        <div class="carousel-caption wow zoomIn animated">
          <h1>EVENT CONCEPTUALIZE AND ORGANIZED BY</h1>
          <p>VPAG (Video Photographers Association of Gujarat)</p>
        </div>
      </div>
    </div>
    <div class="item"> <img class="second-slide" src="<?php echo base_url()?>assets/front/images/slide-2.jpg" alt="Second slide">
      <div class="container">
        <div class="carousel-caption wow zoomIn animated">
          <h1>EVENT CONCEPTUALIZE AND ORGANIZED BY</h1>
          <p>VPAG (Video Photographers Association of Gujarat)</p>
        </div>
      </div>
    </div>
    <div class="item"> <img class="second-slide" src="<?php echo base_url()?>assets/front/images/slide-3.jpg" alt="Second slide">
      <div class="container">
        <div class="carousel-caption wow zoomIn animated">
          <h1>EVENT CONCEPTUALIZE AND ORGANIZED BY</h1>
          <p>VPAG (Video Photographers Association of Gujarat)</p>
        </div>
      </div>
    </div>
    <div class="item"> <img class="second-slide" src="<?php echo base_url()?>assets/front/images/slide-5.jpg" alt="Second slide">
      <div class="container">
        <div class="carousel-caption wow zoomIn animated">
          <h1>EVENT CONCEPTUALIZE AND ORGANIZED BY</h1>
          <p>VPAG (Video Photographers Association of Gujarat)</p>
        </div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#0" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#0" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
<!-- /.carousel --> 

<div class="wel-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-xs-12 welcome">
        <h1>ABOUT VPAG</h1>
        <p>VPAG – Video Photographers Association of Gujarat a name well known in the field of Photography. The Association was formed in 2004 Oct. by leading photographers of Ahmedabad with a motive of social responsibility for the fraternity. One of the only Registered Association under Charity Commissioner of Gujarat & one of the few Association of India which is registered. With a strength of more then 750 odd life members all from the field of Photography & Videography</p>
        <a href="about-us.html" class="read-btn">READ MORE <i class="fa fa-arrow-right"></i></a>
      </div> <!--ABOUT VPAG end-->
      
      <div class="col-lg-5 col-md-7 col-sm-7 col-xs-12">
        <div class="mission-bg">
          <div class="mission">
            <h1>OUR MISSION</h1>
            <p>Reach to the smallest of the person of the industry - Conduct more & more workshops and increase the knowledge of photographers & videographers Make Gujarat the hub of Photography & Videography.</p>
            <h3>Together We Share the Thoughts...</h3>
          </div>
        </div> 
      </div> <!--OUR MISSION end-->
      
      <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
        <div class="events"> <h1>UPCOMING EVENTS</h1>
           <div class="controls pull-right">
              <a class="left fa fa-chevron-left" href="#carousel-example" data-slide="prev"></a>
              <a class="right fa fa-chevron-right" href="#carousel-example" data-slide="next"></a>
            </div>
          <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <a href="all-india-foto-video-fair.html" class="item active">
                  <div class="photo">
                    <img src="images/events-1.png" class="img-responsive center-block" alt="a" />
                  </div>
                  <div class="info">
                    <h2>VENUE</h2>
                    <p>The YMCA International Center Sarkhej Gandhinagar Road, Ahmedabad-380 015.</p>
                  </div>
                </a> <!--item 1 end-->
                
                <a href="all-india-foto-video-fair.html" class="item">
                  <div class="photo">
                    <img src="<?php echo base_url()?>assets/front/images/events-1.png" class="img-responsive center-block" alt="a" />
                  </div>
                  <div class="info">
                    <h2>VENUE</h2>
                    <p>The YMCA International Center Sarkhej Gandhinagar Road, Ahmedabad-380 015.</p>
                  </div>
                </a> <!--item 1 end-->
            </div>
         </div>
         </div>
      </div>  <!-- UPCOMING EVENTS end-->
    </div>
  </div>
</div>  <!--wel-bg end-->

<div class="from-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
        <div class="member"> 
          <figure>
            <img src="<?php echo base_url()?>assets/front/images/member.jpg" class="img-responsive center-block" alt="">
            <figcaption>
              <h1>MEMBERSHIP</h1>
              <h4>Become A Member Join Us!</h4>
              <a href="#" class="read-btn">READ MORE <i class="fa fa-arrow-right"></i></a>
            </figcaption>
          </figure>
        </div> 
      </div>
      
      <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12 form">
          <h1>QUICK CONTACT</h1>
           <form method="post" name="inquiry" id="inquiry" enctype="multipart/form-data">
          <input type="hidden" name="inquiry" id="inquiry" value="inquiry">
            <div class="row">
              <div class="col-md-6 col-sm-12 col-xs-12 pad-rt0">
                <div class="form-group">
                  <input name="name" type="text" class="form-control" placeholder="Name" required>
                  <span class="focus-border"> <i></i> </span> </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="Email" required>
                  <span class="focus-border"> <i></i> </span> </div>
                <div class="form-group">
                  <input type="text"  id="quantity" name="mobile" pattern="[789][0-9]{9}" class="form-control" placeholder="Mobile" required>
                  <span id="errmsg" class="focus-border"> <i></i> </span> </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12 pad-lt0">
                <div class="form-group">
                  <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                  <span class="focus-border"> <i></i> </span> </div>
                <div class="row">
                  <div class="col-xs-6">
                    <div class="form-group">
                      <input name="4_letters_code" id="4_letters_code" placeholder="Enter code" type="code" class="form-control" required>
                      <span class="focus-border"> <i></i> </span> </div>
                  </div>
                  <img src="captcha/captcha1.php?rand=<?php echo rand();?>" id='captchaimg' class="captcha" />
                  <div class="error_1" style="color:red;"></div>
                </div>
              </div>
           <button name="submit" id="button" class="btn btn-now" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Send " value="Submit"><span>Submit</span></button>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>  <!--wel-bg end-->