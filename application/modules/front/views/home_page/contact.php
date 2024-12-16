

<!--sub banner
    ================================================== -->
  <div class="sub-banner text-center" style="background-image:url(<?php echo base_url()?>assets/front/sub-images/about-bnr.jpg)">
    <div class="container">
      <h1>CONTACT</h1>
    </div>  
  </div> <!-- sub banner --> 


<div class="from-bg">
  <div class="container pad-b48">
    <div class="row shadow bg-1">
      <div class="sub-cont contact">
        <div class="row pad-t14">
          <div class="col-sm-5 col-xs-12"> 
            <div class="add"><h1>VPAG</h1>
             <p>25 Dolly Complex, Stadium Circle, <br> Opp. Vodafone House Navragpura, <br> Ahmedabad Gujarat 380009.</p>
             <p class="mrg-t18"><i class="glyphicon glyphicon-phone"></i> <a href="tel:+919227496962">+91 92274 96962</a></p>
             <p><i class="fa fa-envelope"></i> <a href="mailto:info@vpagujarat.org">info@vpagujarat.org</a>, <a href="mailto:vpag2016@gmail.com">vpag2016@gmail.com</a></p>
            </div>
          </div>
           
          <div class="col-sm-7 col-xs-12 form ">
            <h1 class="pad-t14">FEEDBACK FORM</h1>
               <form method="post" name="inquiry"  id="inquiry" enctype="multipart/form-data">
          	<input type="hidden" name="inquiry" id="inquiry" value="inquiry">
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12 pad-rt0">
                    <div class="form-group">
                      <input name="name" type="text" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                      <input name="email" type="email" class="form-control" placeholder="Email" required></div>
                    <div class="form-group">
                      <input type="text" id="quantity" name="mobile" pattern="[789][0-9]{9}"  class="form-control" placeholder="Mobile" required>
                      <span id="errmsg" class="focus-border"> <i></i> </span> </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12 pad-lt0">
                    <div class="form-group">
                      <textarea name="message" class="form-control" placeholder="Message" required></textarea></div>
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <input name="4_letters_code" id="4_letters_code" placeholder="Enter code" type="code" class="form-control" required></div>
                      </div>
                      <img class="pull-left form-group" src="captcha/captcha1.php?rand=<?php echo rand();?>" id='captchaimg'/>
                     <div class="error_1" style="color:red;"></div>
                    </div>
                  </div
                    ><button name="Submit" id="button" class="btn btn-now" type="Submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Send "   value="Submit"><span>Submit</span></button>
                </div>
              </form>
            </div> 
          
          <div class="col-xs-12"> <h1>LOCATION</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.55770289444!2d72.56101940065976!3d23.040006629944276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848b673b3c6d%3A0xadf8114c96851300!2sDolly+Complex%2C+Kamla+Society%2C+Hindu+Colony%2C+Navrangpura%2C+Ahmedabad%2C+Gujarat+380014!5e0!3m2!1sen!2sin!4v1467894039048"  allowfullscreen></iframe>
          </div>
         </div>
      </div>
    </div>
  </div>
</div>  <!--from-bg end-->
