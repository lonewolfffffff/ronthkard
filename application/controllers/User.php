<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Community Auth - Examples Controller
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2015, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

class User extends MY_Controller {
	public function __construct() {
		parent::__construct();

		// Force SSL
		//$this->force_ssl();
	}

    // -----------------------------------------------------------------------

    /**
     * Demonstrate being redirected to login.
     * If you are logged in and request this method,
     * you'll see the message, otherwise you will be
     * shown the login form. Once login is achieved,
     * you will be redirected back to this method.
     */
	public function index() {
		$crud = new grocery_CRUD();
		
		if(!$this->verify_role('admin')) {
			$crud->where('user_name!=','admin');
			$access_level = array(4=>'Sales',5=>'Inventory',6=>'Finance & Accounting');
		}
		else {
			$access_level = array(4=>'Sales',5=>'Inventory',6=>'Finance & Accounting',7=>'Manager',8=>'Business Owner',9=>'Admin');
		}
		
		$crud->set_table('users');
		$crud->set_subject('User');
		$crud->columns('user_name','user_level','user_email','user_last_login');
		$crud->fields('user_name','user_pass','user_email','user_level');
		$crud->display_as('user_name','Username')
				->display_as('user_email','Email')
				->display_as('user_last_login','Terakhir login')
				->display_as('user_pass','Password')
				->display_as('user_level','Level');
		
		$crud->required_fields('user_name','user_pass','user_email','user_level');
		$crud->field_type('user_pass', 'password');
		$crud->field_type('user_level','dropdown',$access_level);
		
		$validation_rules = array(
			array(
				'field' => 'user_name',
				'label' => 'Username',
				'rules' => 'max_length[12]'
			),
			array(
				'field' => 'user_pass',
				'label' => 'Password',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'user_email',
				'label' => 'Email',
				'rules' => 'required|valid_email'
			),
			array(
				'field' => 'user_level',
				'label' => 'Level',
				'rules' => 'required|integer|in_list[4,5,6]'
			)
		);
		
		$crud->set_rules($validation_rules);
		
		$crud->callback_insert(array($this,'create_user_callback'));
		$crud->callback_update(array($this,'update_user_callback'));
		
		$output = $crud->render();
		$output->page_title = 'User';
		$this->load->view('template/default/main',$output);
	}
	
	function create_user_callback($post_array, $primary_key = null) {
		$user_data = array(
            'user_name'     => $post_array['user_name'],
            'user_pass'     => $post_array['user_pass'],
            'user_email'    => $post_array['user_email'],
            'user_level'    => $post_array['user_level'],
			'user_salt'     => $this->authentication->random_salt(),
			'user_pass'     => $this->authentication->hash_passwd($user_data['user_pass'], $user_data['user_salt']),
			'user_id'       => $this->_get_unused_id(),
			'user_date'     => date('Y-m-d H:i:s'),
			'user_modified' => date('Y-m-d H:i:s')
		);

		// If username is not used, it must be entered into the record as NULL
		if(empty($user_data['user_name'])) {
			$user_data['user_name'] = NULL;
		}
		$this->db->set($user_data)->insert(config_item('user_table'));
	}
	
	public function update_user_callback($post_array, $primary_key) {
		$user_data = array(
            'user_name'     => $post_array['user_name'],
            'user_pass'     => $post_array['user_pass'],
            'user_email'    => $post_array['user_email'],
            'user_level'    => $post_array['user_level'],
			'user_salt'     => $this->authentication->random_salt(),
			'user_pass'     => $this->authentication->hash_passwd($user_data['user_pass'], $user_data['user_salt']),
			'user_modified' => date('Y-m-d H:i:s')
		);

		// If username is not used, it must be entered into the record as NULL
		if(empty($user_data['user_name'])) {
			$user_data['user_name'] = NULL;
		}
		$this->db->update(config_item('user_table'),$user_data,array('user_id' => $primary_key));
	}
    
    // -----------------------------------------------------------------------

    /**
     * Demonstrate an optional login.
     * Remember to add "examples/optional_login_test" to the
     * allowed_pages_for_login array in config/authentication.php.
     *
     * Notice that we are using verify_min_level to check if
     * a user is already logged in.
     */
    public function optional_login_test()
    {
        if ($this->verify_min_level(1)) {
            $page_content = '<p>Although not required, you are logged in!</p>';
        } elseif ($this->tokens->match && $this->optional_login()) {
            // Let Community Auth handle the login attempt ...
        } else {
            // Notice parameter set to TRUE, which designates this as an optional login
            $this->setup_login_form(TRUE);

            $page_content = '<p>You are not logged in, but can still see this page.</p>';

            $page_content .= $this->load->view('examples/login_form', '', TRUE);

        }

        echo $this->load->view('examples/page_header', '', TRUE);

        echo $page_content;

        echo $this->load->view('examples/page_footer', '', TRUE);
    }
    
    // -----------------------------------------------------------------------

    /**
     * Here we simply verify if a user is logged in, but
     * not enforcing authentication. The presence of auth 
     * related variables that are not empty indicates 
     * that somebody is logged in. Also showing how to 
     * get the contents of the HTTP user cookie.
     */
    public function simple_verification()
    {
        $this->is_logged_in();

        echo $this->load->view('examples/page_header', '', TRUE);

        echo '<p>';
        if( ! empty( $this->auth_role ) )
        {
            echo $this->auth_role . ' logged in!<br />
                User ID is ' . $this->auth_user_id . '<br />
                Auth level is ' . $this->auth_level . '<br />
                Username is ' . $this->auth_user_name;

            if( $http_user_cookie_contents = $this->input->cookie( config_item('http_user_cookie_name') ) )
            {
                $http_user_cookie_contents = unserialize( $http_user_cookie_contents );
                
                echo '<br />
                    <pre>';

                print_r( $http_user_cookie_contents );

                echo '</pre>';
            }
        }
        else
        {
            echo 'Nobody logged in.';
        }
        echo '</p>';

        echo $this->load->view('examples/page_footer', '', TRUE);
    }
    
    // -----------------------------------------------------------------------

    /**
     * Most minimal user creation. You will of course make your
     * own interface for adding users, and you may even let users
     * register and create their own accounts.
     *
     * The password used in the $user_data array needs to meet the
     * following default strength requirements:
     *   - Must be at least 8 characters long
     *   - Must have at least one digit
     *   - Must have at least one lower case letter
     *   - Must have at least one upper case letter
     *   - Must not have any space, tab, or other whitespace characters
     *   - No backslash, apostrophe or quote chars are allowed
     */
    public function create()
    {
        // Customize this array for your user
        $user_data = array(
            'user_name'     => 'wulan',
            'user_pass'     => 'Testing123',
            'user_email'    => 'wulan@ronthkard.com',
            'user_level'    => '7', // 9 if you want to login @ examples/index.
        );

        $this->load->library('form_validation');

        $this->form_validation->set_data( $user_data );

        $validation_rules = array(
			array(
				'field' => 'user_name',
				'label' => 'user_name',
				'rules' => 'max_length[12]'
			),
			array(
				'field' => 'user_pass',
				'label' => 'user_pass',
				'rules' => 'trim|required|external_callbacks[model,formval_callbacks,_check_password_strength,TRUE]',
			),
			array(
				'field' => 'user_email',
				'label' => 'user_email',
				'rules' => 'required|valid_email'
			),
			array(
				'field' => 'user_level',
				'label' => 'user_level',
				'rules' => 'required|integer|in_list[5,6,7,8,9]'
			)
		);

		$this->form_validation->set_rules( $validation_rules );

		if( $this->form_validation->run() )
		{
			$user_data['user_salt']     = $this->authentication->random_salt();
			$user_data['user_pass']     = $this->authentication->hash_passwd($user_data['user_pass'], $user_data['user_salt']);
			$user_data['user_id']       = $this->_get_unused_id();
			$user_data['user_date']     = date('Y-m-d H:i:s');
			$user_data['user_modified'] = date('Y-m-d H:i:s');

            // If username is not used, it must be entered into the record as NULL
            if( empty( $user_data['user_name'] ) )
            {
                $user_data['user_name'] = NULL;
            }

			$this->db->set($user_data)
				->insert(config_item('user_table'));

			if ($this->db->affected_rows() == 1) {
				echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data['user_name'] . ' was created.</p>';
			}
		}
		else
		{
			echo '<h1>User Creation Error(s)</h1>' . validation_errors();
		}
    }
    
    // -----------------------------------------------------------------------

    /**
     * This login method only serves to redirect a user to a 
     * location once they have successfully logged in. It does
     * not attempt to confirm that the user has permission to 
     * be on the page they are being redirected to.
     */
    public function login()
    {
        // Method should not be directly accessible
        if( $this->uri->uri_string() == 'user/login')
        {
            show_404();
        }

        if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
        {
            $this->require_min_level(1);
        }

        $this->setup_login_form();
		
		$data['page'] = 'auth/login';
		$this->load->view('template/auth/main',$data);
    }

    // --------------------------------------------------------------

    /**
     * Log out
     */
    public function logout()
    {
        $this->authentication->logout();

        redirect( secure_site_url( LOGIN_PAGE . '?logout=1') );
    }

    // --------------------------------------------------------------

    /**
     * User recovery form
     */
    public function recover()
    {
        // Load resources
        $this->load->model('examples_model');

        /// If IP or posted email is on hold, display message
        if( $on_hold = $this->authentication->current_hold_status( TRUE ) )
        {
            $view_data['disabled'] = 1;
        }
        else
        {
            // If the form post looks good
            if( $this->tokens->match && $this->input->post('user_email') )
            {
                if( $user_data = $this->examples_model->get_recovery_data( $this->input->post('user_email') ) )
                {
                    // Check if user is banned
                    if( $user_data->user_banned == '1' )
                    {
                        // Log an error if banned
                        $this->authentication->log_error( $this->input->post('user_email', TRUE ) );

                        // Show special message for banned user
                        $view_data['user_banned'] = 1;
                    }
                    else
                    {
                        /**
                         * Use the string generator to create a random string
                         * that will be hashed and stored as the password recovery key.
                         */
                        $this->load->library('generate_string');
                        $recovery_code = $this->generate_string->set_options( 
                            array( 'exclude' => array( 'char' ) ) 
                        )->random_string(64)->show();

                        $hashed_recovery_code = $this->_hash_recovery_code( $user_data->user_salt, $recovery_code );

                        // Update user record with recovery code and time
                        $this->examples_model->update_user_raw_data(
                            $user_data->user_id,
                            array(
                                'passwd_recovery_code' => $hashed_recovery_code,
                                'passwd_recovery_date' => date('Y-m-d H:i:s')
                            )
                        );

                        $view_data['special_link'] = secure_anchor( 
                            'examples/recovery_verification/' . $user_data->user_id . '/' . $recovery_code, 
                            secure_site_url( 'examples/recovery_verification/' . $user_data->user_id . '/' . $recovery_code ), 
                            'target ="_blank"' 
                        );

                        $view_data['confirmation'] = 1;
                    }
                }

                // There was no match, log an error, and display a message
                else
                {
                    // Log the error
                    $this->authentication->log_error( $this->input->post('user_email', TRUE ) );

                    $view_data['no_match'] = 1;
                }
            }
        }

        echo $this->load->view('examples/page_header', '', TRUE);

        echo $this->load->view('examples/recover_form', ( isset( $view_data ) ) ? $view_data : '', TRUE );

        echo $this->load->view('examples/page_footer', '', TRUE);
    }

    // --------------------------------------------------------------

    /**
     * Verification of a user by email for recovery
     * 
     * @param  int     the user ID
     * @param  string  the passwd recovery code
     */
    public function recovery_verification( $user_id = '', $recovery_code = '' )
    {
        /// If IP is on hold, display message
        if( $on_hold = $this->authentication->current_hold_status( TRUE ) )
        {
            $view_data['disabled'] = 1;
        }
        else
        {
            // Load resources
            $this->load->model('examples_model');

            if( 
                /**
                 * Make sure that $user_id is a number and less 
                 * than or equal to 10 characters long
                 */
                is_numeric( $user_id ) && strlen( $user_id ) <= 10 &&

                /**
                 * Make sure that $recovery code is exactly 64 characters long
                 */
                strlen( $recovery_code ) == 64 &&

                /**
                 * Try to get a hashed password recovery 
                 * code and user salt for the user.
                 */
                $recovery_data = $this->examples_model->get_recovery_verification_data( $user_id ) )
            {
                /**
                 * Check that the recovery code from the 
                 * email matches the hashed recovery code.
                 */
                if( $recovery_data->passwd_recovery_code == $this->_hash_recovery_code( $recovery_data->user_salt, $recovery_code ) )
                {
                    $view_data['user_id']       = $user_id;
                    $view_data['user_name']     = $recovery_data->user_name;
                    $view_data['recovery_code'] = $recovery_data->passwd_recovery_code;
                }

                // Link is bad so show message
                else
                {
                    $view_data['recovery_error'] = 1;

                    // Log an error
                    $this->authentication->log_error('');
                }
            }

            // Link is bad so show message
            else
            {
                $view_data['recovery_error'] = 1;

                // Log an error
                $this->authentication->log_error('');
            }

            /**
             * If form submission is attempting to change password 
             */
            if( $this->tokens->match )
            {
                $this->examples_model->recovery_password_change();
            }
        }

        echo $this->load->view('examples/page_header', '', TRUE);

        echo $this->load->view( 'examples/choose_password_form', $view_data, TRUE );

        echo $this->load->view('examples/page_footer', '', TRUE);
    }

    // --------------------------------------------------------------

    /**
     * Hash the password recovery code (uses the authentication library's hash_passwd method)
     */
    private function _hash_recovery_code( $user_salt, $recovery_code )
    {
        return $this->authentication->hash_passwd( $recovery_code, $user_salt );
    }

    // --------------------------------------------------------------
    
    /**
     * Get an unused ID for user creation
     *
     * @return  int between 1200 and 4294967295
     */
    private function _get_unused_id()
    {
        // Create a random user id
        $random_unique_int = 2147483648 + mt_rand( -2147482447, 2147483647 );

        // Make sure the random user_id isn't already in use
        $query = $this->db->where('user_id', $random_unique_int)
            ->get_where(config_item('user_table'));

        if ($query->num_rows() > 0) {
            $query->free_result();

            // If the random user_id is already in use, get a new number
            return $this->_get_unused_id();
        }

        return $random_unique_int;
    }

    // --------------------------------------------------------------
}

/* End of file Examples.php */
/* Location: /application/controllers/Examples.php */
