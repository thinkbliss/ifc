<?php
/*
Plugin Name: AMCN SMTP
Description: Overrides wp_mail() for use with AMCN SMTP servers
Version: 0.1
Author: Brian Fegter
*/

class AMCN_SMTP{

	private $config;
	static $admin_notice;
	static $wp_mail = false;

	function __construct(){
		$this->get_config();
		add_filter('wp_mail_from', array($this, 'from'));
		add_filter('wp_mail_from_name', array($this, 'from_name'));
		add_filter('wp_mail_content_type', array($this, 'content_type'));
		add_action('admin_init', array($this, 'maybe_send_test'), 999999);
		add_filter('phpmailer_init', array($this, 'settings'));
		add_action('admin_head', array($this, 'sniff_emails'));
		add_action('admin_notices', array($this, 'admin_notices'));
	}

	private function get_config(){
		$docroot = trim(ABSPATH, '/');
		$docroot_parts = explode('/', $docroot);
		$count = count($docroot_parts) - 1;
		unset($docroot_parts[$count]);
		$one_above_docroot = '/'.implode('/', $docroot_parts);
		require "$one_above_docroot/smtp-config.php";
		if($smtp_config && is_array($smtp_config))
			$this->config = (object)$smtp_config;
		else
			error_log("\$smtp_config (array) not found in $one_above_docroot/smtp-config.php");
	}

	public function from($from){
		return $this->config->from_email;
	}

	public function from_name($from_name){
		return $this->config->from_name;
	}

	public function content_type($type){
		return $this->config->content_type ? $this->config->content_type : 'text/plain';
	}

	public function settings(&$phpmailer){
		if($this->config){
			$phpmailer->IsSMTP();
			$phpmailer->Host = $this->config->host;
			$phpmailer->Port = $this->config->port;
			$phpmailer->SMTPAuth = $this->config->auth;
			if(isset($this->config->auth) && $this->config->auth){
				$phpmailer->Username = $this->config->user;
				$phpmailer->Password = $this->config->pass;
			}
			if(isset($config->secure) && $this->config->secure)
				$phpmailer->SMTPSecure = $this->config->secure;
			if(isset($config->wordwrap) && $this->config->wordwrap)
				$phpmailer->WordWrap = $this->config->wordwrap;
			if(isset($config->debug) && $this->config->debug)
				$phpmailer->SMTPDebug = $this->config->debug;
			self::$wp_mail = true;
		}
	}

	public function maybe_send_test(){
		if(!is_admin())
			return;
		if ( isset($_GET['send-test-email']) && $_GET['send-test-email'] === 'benderisbest' ) {
			$user = wp_get_current_user();
			if(!current_user_can('manage_options')){
				self::$admin_notice = 'Only administrators have permission to send test emails. This issue has been reported.';
				return;
			}
			$email = $user->user_email;
			$timestamp = current_time( 'mysql' );
			$message = sprintf( __( 'AMCN SMTP configured properly! Sent at: %s'), $timestamp );
			wp_mail( $email, __( 'Test message from AMCN SMTP'), $message );

			global $phpmailer;
			if ( $phpmailer->ErrorInfo != "" ) {
				$this->set_error_notice('An error was encountered while trying to send the test e-mail.');
			}
			else
				$this->set_success_notice('Test email sent to '. $email);
		}
	}

	public function sniff_emails(){
		if(self::$wp_mail && !self::$admin_notice){
			global $phpmailer;
			if ( $phpmailer->ErrorInfo != "" )
				$this->set_error_notice('There was an error sending your email.');
			else
				$this->set_success_notice('Email sent!');
		}
	}

	public function admin_notices(){
		if(self::$admin_notice)
			echo self::$admin_notice;
	}

	public function set_error_notice($message){
		global $phpmailer;
		self::$admin_notice  = '<div class="error"><p>' . $message . '</p>';
		self::$admin_notice .= '<blockquote style="font-weight:bold;">';
		self::$admin_notice .= '<p>' . $phpmailer->ErrorInfo . '</p>';
		self::$admin_notice .= '</p></blockquote>';
		self::$admin_notice .= '</div>';
	}

	protected function set_success_notice($message){
		self::$admin_notice  = '<div class="updated"><p>' .$message. '</p></div>';
	}
}
new AMCN_SMTP;
