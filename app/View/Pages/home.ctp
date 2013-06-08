    <section class="row" id="contentTop">
        <section class="span5 alpha" id="callToAction">
            <h2>Framio helps you showcase your photographs, tell stories and connect with great talent near you.</h2>
            <?php echo $this->Html->link('Take a tour', array('controller'=>'pages','action'=>'display', 'tour'), array('title'=>'Learn more!', 'id' => 'takeATourButton')); ?>
        </section>
        <section class="span3 offset4 omega" id="logInForm">
            <form action="#" id="login">
                <input type="text" value="Email" id="emailForm" />
                <input type="password" value="Password" id="passForm" />
                <input type="submit" value="Sign in" id="signInButton" />
            </form>
            <p>New here? <?php echo $this->Html->link('Sign up for an invite', array('controller'=>'invitations','action'=>'apply'), array('title'=>'Come in!')); ?>!</p>
            <p><a href="#">Forgot your password</a>?</p>
        </section>
    </section>
    <section class="grid_12 marginsAndBorders" id="featureList">
        <section class="grid_3 featureItem alpha" id="featureCreate">
            <h3>Create</h3>
            <img src="images/featureCreate.jpg" alt="customize your profile design on framio" />
            <p>Choose between a number of designs for your profile nd customize it to make it unique to you. Get your publicly accessible framio.net/you URL today!</p>
            <a href="#" title="Find out more" class="moreLink">More</a>
        </section>
        <section class="grid_3 featureItem" id="featureConnect">
            <h3>Connect</h3>
            <img src="images/featureConnect.jpg" alt="connect with photographers on framio" />
            <p>Framio caters for you and your friends! Connect with fellow photographers and friends, share your photos and find local events.</p>
            <a href="#" title="Find out more" class="moreLink">More</a>
        </section>
        <section class="grid_3 featureItem" id="featurePrivacy">
            <h3>Privacy</h3>
            <img src="images/featurePrivacy.jpg" alt="protect your photos on framio" />
            <p>Configure every photo to be seen by everyone, friends or only you. With Creative Commons licensing, keep your photos safe from content theft.</p>
            <a href="#" title="Find out more" class="moreLink">More</a>
        </section>
        <section class="grid_3 featureItem omega" id="featureMobile">
            <h3>Mobile</h3>
            <img src="images/featureMobile.jpg" alt="get a mobile version website on framio" />
            <p>A mobile version of your porfile to top it off. All the features you enjoy are available on-the-go, plus geo-tagging.</p>
            <a href="#" title="Find out more" class="moreLink">More</a>
        </section>
    </section>
    <section class="grid_12 marginsAndBorders" id="invitesCallToAction">
        <section class="grid_8 alpha" id="inviteText">
            <h3>We’re sending out invites, get your framio profile today.</h3>
            <p>Fill in your name, phone number and a reference for your portfolio (a Facebook page, personal website, etc.) Write to us, it only takes a minute.</p>
        </section>
        <section class="grid_4 omega" id="inviteCallToAction">
            <?php echo $this->Html->link('Sign up for an invite', array('controller'=>'invitations','action'=>'apply'), array('title'=>'Come in!', 'id' => 'signUpForAnInviteButton')); ?>
        </section>
    </section>
    <section class="grid_12 marginsAndBorders" id="communityShowcase">
        <section class="grid_8 alpha" id="communityPhotos">
            <h2>Great new photos from the network</h2>
            <img src="images/greatPhotos.jpg" alt="great photos on framio" />
        </section>
        <section class="grid_4 omega" id="communityPhotoSets">
            <h2>Discover photo sets</h2>
            <section class="grid_4 photoSet alpha omega" id="set1">
                <img src="images/lowTonesPhotos.jpg" alt="low key tones photography on framio" />
                <p>Curated by <a href="#">username</a></p>
            </section>
            <section class="grid_4 photoSet alpha omega" id="set2">
                <img src="images/rockConcertPhotos.jpg" alt="rock concert photos on framio" />
                <p>Curated by <a href="#">username</a></p>
            </section>
            <section class="grid_4 photoSet alpha omega" id="set1">
                <img src="images/redBullPhotos.jpg" alt="redbull photos on framio" />
                <p>Curated by <a href="#">username</a></p>
            </section>
        </section>
    </section>