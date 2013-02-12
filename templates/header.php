<?php

class pageHeader{

    public function pageHead($ctrl){
    echo '<div id="header" class="container cB bB">
            <div class="row">
                <div class="sixcol">
                    <div id="logo"><a href="index.php"><img src="photos/UNF_Logo.gif"/></a></div>
                    <div id="motto"><a href="index.php"><img src="photos/volunteer_center_logo.gif"></a></div>
                </div>
                <div class="sixcol last">

                    <div id="loginWrapper">';


                    if(isset($_SESSION['studentUser'])){
                        echo '<a href="studentProfile.php"><span class="uName">'.$ctrl->sCtrl->student->sEmail.'</span></a>'; 
                        echo '<a href="index.php?logout"><span id="logout">logout</span></a>';
                    }
                    else if(isset($_SESSION['orgUser'])){
                        echo '<a href="organizationProfile.php"><span class="uName">'.$ctrl->oCtrl->org->email.'</span></a>';
                        echo '<a href="index.php?logout"><span id="logout">logout</span></a>';
                    }
                    else if(isset($_SESSION['admin'])){
                        echo '<a href="organizationProfile.php"><span class="uName">'.$ctrl->adminCtrl->admin->sEmail.'</span></a>';
                        echo '<a href="index.php?logout"><span id="logout">logout</span></a>';
                    }
                    else{

                        echo '<div id="viewLogin" >
                                    <span id="login" v=0>Login</span>
                                    <span> | </span>
                                    <span id="signup" v=0>Sign up</span>
                                    <span> | </span>
                                    <span id="oSignup" v=0>Organization Sign up</span>
                                </div>';

                        $this->loginForm();
                        $this->signupForm();
                        $this->oSignupForm();

                        if(!empty($ctrl->error)){
                            echo '</br><div id="loginError"><span>'.$ctrl->error.'</span></div>';
                        }//end if

                        }//end else	
                    echo '</div></div></div></div>';
 
    }//end pageHead

    private function loginForm(){
    echo '<div id="loginDiv" style="display:none;">	
            <form id="form2" class="loginForm">	
			<fieldset>
                                <p>
					<label for="email">Email</label>
					<input type="text" name="loginEmail" id="email" size="60" />
				</p>
	                         <p>
					<label for="password">Password</label>
					<input type="password" name="password" id="password" size="30" />
				</p>
		
				<p class="submit"><button id="loginButton" name="login">Send</button></p>		
							
			</fieldset>					
						
		</form>
        </div>';
    }//end loginForm

    private function signupForm(){
    echo '<div id="signupDiv" style="display:none;">	
            <form id="form2" action="index.php" method="post">	
			<fieldset>
                                <p>
					<label for="email">UNF Email</label>
					<input type="text" name="email" id="signupEmail" size="60" />
				</p>
                                <p>
					<label for="email">N#</label>
					<input type="text" name="nNumber" id="nNumber" size="9" />
				</p>
                                <p>
					<label for="email">First Name</label>
					<input type="text" name="firstName" id="signupFirstName" size="30" />
				</p>
                                <p>
					<label for="email">Last Name</label>
					<input type="text" name="lastName" id="signupLastName" size="30" />
				</p>

	                         <p>
					<label for="password">Password</label>
					<input type="password" name="password" id="password" size="30" />
					<input type="password" name="passwordMatch" id="password" size="30" />
				</p>
		
				<p class="submit"><button name="signup" type="submit">Send</button></p>		
							
			</fieldset>					
						
                        </form>
                        </div>';

    }//end singupForm

    private function oSignupForm(){
    echo '<div id="oSignupDiv" style="display:none;">	
            <form id="form2" action="index.php" method="post" enctype="multipart/form-data">	
			<fieldset>
                                <p>
					<label for="oName">Organization Name</label>
					<input type="text" name="oName" id="oName" size="60" />
				</p>
                                <p>
					<label for="email">Description</label>
					<input type="text" name="oDescr" id="nNumber" size="1200" />
				</p>
                                <p>
					<label for="email">Logo</label>
					<input type="file" name="oPhoto" id="oPhoto"/>
				</p>
                                <p>
					<label for="email">Main Contact Email</label>
					<input type="text" name="oEmail" id="oEmail" size="30" />
				</p>
                                <p>
					<label for="oFName">First Name</label>
					<input type="text" name="oFName" id="oFName" size="30" />
				</p>
                                <p>
					<label for="oLName">Last Name</label>
					<input type="text" name="oLName" id="oLName" size="30" />
				</p>
                                <p>
					<label for="email">Headshot (optional)</label>
					<input type="file" name="oContactPhoto" id="oContactPhoto"/>
				</p>


	                         <p>
					<label for="password">Password</label>
					<input type="password" name="password" id="password" size="30" />
					<input type="password" name="passwordMatch" id="password" size="30" />
				</p>
		
				<p class="submit"><button name="oSignup" type="submit">Send</button></p>		
							
			</fieldset>					
						
                        </form>
                        </div>';

    }//end singupForm




}//end class header




?>
