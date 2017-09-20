<?php
global $rcp_options;

$member_add_first = get_user_meta( get_current_user_id(), 'sm_parent_2_first', true );
$member_add_last   = get_user_meta( get_current_user_id(), 'sm_parent_2_last', true );
$member_add_email   = get_user_meta( get_current_user_id(), 'sm_parent_2_email', true );

if ( ! did_action( 'rcpga_dashboard_notifications' ) ) {
	do_action( 'rcpga_dashboard_notifications' );
}
?>

<h4 class="rcp-header"><?php _e( 'Add Group Members', 'rcp-group-accounts' ); ?></h4>

<form method="post" id="rcpga-group-member-add-form" class="rcp_form">

	<fieldset>

		<p id="rcpga-group-member-first-name-wrap">
			<label for="rcpga-group-member-first-name"><?php _e( 'Member First Name', 'rcp-group-accounts' ); ?></label>
			<input type="text" name="rcpga-first-name" id="rcpga-group-member-first-name" value="<?php echo esc_attr( $member_add_first ); ?>" autocomplete="off" />
		</p>

		<p id="rcpga-group-member-last-name-wrap">
			<label for="rcpga-group-member-last-name"><?php _e( 'Member Last Name', 'rcp-group-accounts' ); ?></label>
			<input type="text" name="rcpga-last-name" id="rcpga-group-member-last-name" value="<?php echo esc_attr( $member_add_last ); ?>" autocomplete="off" />
		</p>

		<p id="rcpga-group-member-email-wrap">
			<label for="rcpga-group-member-email"><?php _e( 'Member Email', 'rcp-group-accounts' ); ?></label>
			<input type="email" name="rcpga-user-email" id="rcpga-group-member-email" placeholder="<?php _e( 'Email', 'rcp-group-accounts' ); ?>" value="<?php echo esc_attr( $member_add_email ); ?>" autocomplete="off" />
		</p>

		<p id="rcpga-group-member-login-wrap">
			<label for="rcpga-group-member-login"><?php _e( 'Member Username (optional)', 'rcp-group-accounts' ); ?></label>
			<input type="text" name="rcpga-user-login" id="rcpga-group-member-login" placeholder="<?php esc_attr_e( 'Username', 'rcp-group-accounts' ); ?>" autocomplete="off" />
			<span><?php _e( 'If left blank, the member\'s email address will be used.', 'rcp-group-accounts' ); ?></span>
		</p>

		<p id="rcpga-group-member-password-wrap">
			<label for="rcpga-group-member-password"><?php _e( 'Member Password (optional)', 'rcp-group-accounts' ); ?></label>
			<input type="password" name="rcpga-user-password" id="rcpga-group-member-password" placeholder="<?php esc_attr_e( 'Password', 'rcp-group-accounts' ); ?>" autocomplete="off" />
			<span><?php _e( 'If left blank, the password will be randomly generated.', 'rcp-group-accounts' ); ?></span>
		</p>

		<?php if( isset( $rcp_options['group_invite_email'] ) && empty( $rcp_options['disable_group_invite_email'] ) ) : ?>
			<p id="rcpga-group-member-disable-invite-wrap">
				<label for="rcpga-group-member-disable-invite">
					<input type="checkbox" name="rcpga-disable-invite-email" id="rcpga-group-member-disable-invite" />
					<?php _e( 'Disable the group invite email and automatically add this user to the group.', 'rcp-group-accounts' ); ?>
					<?php if ( empty( $rcp_options['disable_new_user_notices'] ) ) : ?>
						<?php _e( '(If a new user is created, then the new user notification will be sent out.)', 'rcp-group-accounts' ); ?>
					<?php endif; ?>
				</label>
			</p>
		<?php endif; ?>

		<p class="rcp_submit_wrap">
			<input type="hidden" name="rcpga-group" value="<?php echo absint( rcpga_group_accounts()->members->get_group_id() ); ?>" />
			<input type="hidden" name="rcpga-action" value="add-member" />
			<input type="submit" value="<?php _e( 'Add Member', 'rcp-group-accounts' ); ?>" />
		</p>
	</fieldset>

</form>
