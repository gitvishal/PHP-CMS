<div class="col-md-6">
            <div class="well well-sm">
                <form class="form-horizontal" method="post" id="contact" action="post-contact.php">
                    <fieldset>
                        <legend class="text-center header">Contact us</legend>

                        <div class="form-group">
                            <span class="col-md-1  text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="fname" name="fname" type="text" placeholder="Full Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1  text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="lname" name="lname" type="text" placeholder="Last Name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1  text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1  text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1  text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <textarea class="form-control" id="message" name="message" placeholder="Enter your massage " rows="7"></textarea>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                             <div id="recaptcha1"></div>
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

<script>

$(document).ready(function() 
{
    $('#contact').submit(function(event) 
    {
        $.post("post-contact.php",
            $(this).serialize(),
            function(data)
            {
                alert("your contact is successfully stored ");
            },
            "json")
        .fail(function() 
        {
            alert( "error while submitting" );
        });
        event.preventDefault();
    });
});






</script>
