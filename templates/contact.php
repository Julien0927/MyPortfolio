<h2 class="textCenter mb-5">CONTACT</h2>
    <form method="POST" action="contact.php" id="contactForm">
        <div class="row center">
            <div class="col-md-5 form">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="firstname" placeholder="name@example.com">
                    <label for="floatingInput">Firstname</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="name" placeholder="name@example.com">
                    <label for="floatingInput">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" name="email"placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
            </div>
            <div class="col-md-5">
                <textarea type="text" class="form-control" name="message" placeholder="Leave a comment here..." id="floatingTextarea" rows="8"></textarea>
                <label for="floatingTextarea"></label>
            </div>
        </div>
        <div class="center">
            <?php addCSRFTokenToForm(); ?>
            <button type="submit" class="btn mt-3 mb-5 px-5">Submit</button>
        </div>
    </form>  
                
