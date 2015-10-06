<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Login Form View
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2015, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

if( ! isset( $optional_login ) )
{
	
}

if( ! isset( $on_hold_message ) )
{
	if( isset( $login_error_mesg ) )
	{
		?>
		<div class="alert alert-danger" role="alert">
			<p><strong>Login Error:</strong> Anda salah memasukkan Username, Email Address, atau Password.</p>
			<p>Pastikan huruf besar/kecil Username, email address dan password anda sudah benar</p>
		</div>
		<?php
	}

	if( $this->input->get('logout') ) {
		?>
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Terima kasih. Anda telah berhasil <strong>log out</strong>.
			</div>
		<?php
	}

	echo form_open( $login_url, array( 'class' => 'form-signin' ) ); 
?>

		<img class="img-responsive" src="<?php echo base_url('assets/img/logo-ronthkard.png'); ?>" alt="Ronthkard" title="logo" id="logo">
		<h2 class="form-signin-heading">&nbsp;</h2>
		<label class="sr-only" for="inputEmail">User</label>
		<input type="text" autofocus="" required="" placeholder="User" class="form-control" id="inputUser" name="login_string" value="" autocomplete="off">
		<label class="sr-only" for="inputPassword">Password</label>
		<input type="password" required="" placeholder="Password" class="form-control" id="inputPassword" name="login_pass" value="" autocomplete="off">
		<div class="checkbox hidden">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button type="submit" class="btn btn-lg btn-primary btn-block">Masuk</button>
	</form>

<?php

	}
	else
	{
		// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
		echo '
			<div style="border:1px solid red;">
				<p>
					Excessive Login Attempts
				</p>
				<p>
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				<p>
				<p>
					Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
				</p>
				<p>
					Please use the ' . secure_anchor('user/recover','Account Recovery') . ' after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				</p>
			</div>
		';
	}

/* End of file login_form.php */
/* Location: /views/examples/login_form.php */ 