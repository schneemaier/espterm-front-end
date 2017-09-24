<?php

return [
	'appname' => 'ESPTerm',
	'appname_demo' => 'ESPTerm<sup> DEMO</sup>',

	'menu.cfg_wifi' => 'WiFi Settings',
	'menu.cfg_network' => 'Network Settings',
	'menu.cfg_term' => 'Terminal Settings',
	'menu.about' => 'About ESPTerm',
	'menu.help' => 'Quick Reference',
	'menu.term' => 'Back to Terminal',
	'menu.cfg_system' => 'System Settings',
	'menu.cfg_wifi_conn' => 'Connecting to Network',

	'menu.settings' => 'Settings',

	'title.term' => 'Terminal',

	'term_nav.config' => 'Config',
	'term_nav.wifi' => 'WiFi',
	'term_nav.help' => 'Help',
	'term_nav.about' => 'About',
	'term_nav.paste' => 'Paste',
	'term_nav.upload' => 'Upload',
	'term_nav.keybd' => 'Keyboard',
	'term_nav.paste_prompt' => 'Paste text to send:',

	'net.ap' => 'DHCP Server (AP)',
	'net.sta' => 'DHCP Client (Station)',
	'net.sta_mac' => 'Station MAC',
	'net.ap_mac' => 'AP MAC',
	'net.details' => 'MAC addresses',

	'term.defaults' => 'Initial Settings',
	'term.expert' => 'Expert Options',
	'term.explain_initials' => '
		Those are the initial settings used after ESPTerm powers on or when the screen
		reset command is received. Some options can be changed by the application via escape sequences, 
		those changes won\'t be saved in Flash.
		',
	'term.explain_expert' => '
		Those are advanced config options that usually don\'t need to be changed.
		Edit them only if you know what you\'re doing.',

	'term.example' => 'Default colors preview',

	'term.explain_scheme' => '
		To select default text and background color, click on the
		preview palette. Alternatively, use numbers 0-15 for theme colors, 16-255 for standard 
		colors and hex (#FFF or #FFFFFF) for True Color (24-bit).
		',

	'term.fgbg_presets' => 'Presets',
	'term.color_scheme' => 'Color Scheme',
	'term.reset_screen' => 'Reset screen & parser',
	'term.term_title' => 'Header text',
	'term.term_width' => 'Width',
	'term.term_height' => 'Height',
	'term.buttons' => 'Button labels',
	'term.theme' => 'Color scheme',
	'term.cursor_shape' => 'Cursor style',
	'term.parser_tout_ms' => 'Parser timeout',
	'term.display_tout_ms' => 'Redraw delay',
	'term.display_cooldown_ms' => 'Redraw cooldown',
	'term.fn_alt_mode' => 'SS3 Fn keys',
	'term.show_config_links' => 'Show nav links',
	'term.show_buttons' => 'Show buttons',
	'term.loopback' => 'Local Echo',
	'term.crlf_mode' => 'Enter sends CR+LF',
	'term.want_all_fn' => 'Capture all keys<br>(F5, F11, F12…)',
	'term.button_msgs' => 'Button codes<br>(ASCII, dec, CSV)',
	'term.color_fg' => 'Default fg.',
	'term.color_bg' => 'Default bg.',
	'term.color_fg_prev' => 'Fg. colors',
	'term.color_bg_prev' => 'Bg. colors',
	'term.colors_preview' => 'Defaults',

	'cursor.block_blink' => 'Block, blinking',
    'cursor.block_steady' => 'Block, steady',
    'cursor.underline_blink' => 'Underline, blinking',
    'cursor.underline_steady' => 'Underline, steady',
    'cursor.bar_blink' => 'I-bar, blinking',
    'cursor.bar_steady' => 'I-bar, steady',

//	// terminal color labels
//	'color.0' => 'Black',
//	'color.1' => 'Red',
//	'color.2' => 'Green',
//	'color.3' => 'Yellow',
//	'color.4' => 'Blue',
//	'color.5' => 'Purple',
//	'color.6' => 'Cyan',
//	'color.7' => 'Silver',
//	'color.8' => 'Gray',
//	'color.9' => 'Light Red',
//	'color.10' => 'Light Green',
//	'color.11' => 'Light Yellow',
//	'color.12' => 'Light Blue',
//	'color.13' => 'Light Purple',
//	'color.14' => 'Light Cyan',
//	'color.15' => 'White',

	'net.explain_sta' => '
		Switch off Dynamic IP to configure the static IP address.',

	'net.explain_ap' => '
		Those settings affect the built-in DHCP server in AP mode.',

	'net.ap_dhcp_time' => 'Lease time',
	'net.ap_dhcp_start' => 'Pool start IP',
	'net.ap_dhcp_end' => 'Pool end IP',
	'net.ap_addr_ip' => 'Own IP address',
	'net.ap_addr_mask' => 'Subnet mask',

	'net.sta_dhcp_enable' => 'Use dynamic IP',
	'net.sta_addr_ip' => 'ESPTerm static IP',
	'net.sta_addr_mask' => 'Subnet mask',
	'net.sta_addr_gw' => 'Gateway IP',

	'wifi.ap' => 'Built-in Access Point',
	'wifi.sta' => 'Join Existing Network',

	'wifi.enable' => 'Enabled',
	'wifi.tpw' => 'Transmit power',
	'wifi.ap_channel' => 'Channel',
	'wifi.ap_ssid' => 'AP SSID',
	'wifi.ap_password' => 'Password',
	'wifi.ap_hidden' => 'Hide SSID',
	'wifi.sta_info' => 'Selected',

	'wifi.not_conn' => 'Not connected.',
	'wifi.sta_none' => 'None',
	'wifi.sta_active_pw' => '🔒 Password saved',
	'wifi.sta_active_nopw' => '🔓 Open access',
	'wifi.connected_ip_is' => 'Connected, IP is ',
	'wifi.sta_password' => 'Password:',

	'wifi.scanning' => 'Scanning',
	'wifi.scan_now' => 'Click here to start scanning!',
	'wifi.cant_scan_no_sta' => 'Click here to enable client mode and start scanning!',
	'wifi.select_ssid' => 'Available networks:',
	'wifi.enter_passwd' => 'Enter password for ":ssid:"',
	'wifi.sta_explain' => 'After selecting a network, press Apply to connect.',

	'wifi.conn.status' => 'Status:',
	'wifi.conn.back_to_config' => 'Back to WiFi config',
	'wifi.conn.telemetry_lost' => 'Telemetry lost; something went wrong, or your device disconnected.',
	'wifi.conn.explain_android_sucks' => '
		If you\'re configuring ESPTerm via a smartphone, or were connected
		from another external network, your device may lose connection and this 
		progress indicator won\'t work. Please wait a while (~ 15 seconds), 
		then check if the connection succeeded.',

	'wifi.conn.explain_reset' => '
		To force enable the built-in AP, hold the BOOT 
		button until the blue LED starts flashing. Hold the button longer (until the LED 
		flashes rapidly) for a "factory reset".',

	'wifi.conn.disabled' =>"Station mode is disabled.",
	'wifi.conn.idle' =>"Idle, not connected and has no IP.",
	'wifi.conn.success' => "Connected! Received IP ",
	'wifi.conn.working' => "Connecting to selected AP",
	'wifi.conn.fail' => "Connection failed, check settings & try again. Cause: ",

	'system.save_restore' => 'Save & Restore',
	'system.confirm_restore' => 'Restore all settings to their default values?',
	'system.confirm_restore_hard' =>
		'Restore to firmware default settings? This will reset ' .
		'all active settings and switch to AP mode with the default SSID.',
	'system.confirm_store_defaults' =>
		'Enter admin password to confirm you want to overwrite the default settings.',
	'system.password' => 'Admin password:',
	'system.restore_defaults' => 'Reset to saved defaults',
	'system.write_defaults' => 'Save active settings as defaults',
	'system.restore_hard' => 'Reset active settings to firmware defaults',
	'system.explain_persist' => '
		ESPTerm saves all settings in Flash. The active settings can be copied to
		the "defaults area" and restored later using the blue button below.
		',
	'system.uart' => 'Serial Port',
	'system.explain_uart' => '
		This form controls the primary, communication UART. The debug UART is fixed 
		at 115.200 baud, one stop-bit and no parity.
		',

	'system.security' => 'Access Restrictions',
	'system.explain_security' => '
		Some parts, or all of the web interface can be protected by a password prompt.
		Leave the new password fields empty if you do not wish to change it.
	',
	'system.pwlock' => 'Protected pages',
	'system.pwlock.none' => 'None, all open',
	'system.pwlock.settings_noterm' => 'WiFi, Net & System settings',
	'system.pwlock.settings' => 'All settings pages',
	'system.pwlock.menus' => 'This entire menu section',
	'system.pwlock.all' => 'Everything, even terminal',
	'system.new_access_pw' => 'New password',
	'system.new_access_pw2' => 'New pass., repeat',
	'system.admin_pw' => 'Admin password',
	'system.access_name' => 'Username',

	'system.change_adminpw' => 'Change Admin Password',
	'system.explain_adminpw' =>
		'
		The "admin password" is used to manipulate the stored default settings
		and to change access restrictions. This password is not saved as part 
		of the main config, i.e. using save / restore does not affect this 
		password. When the admin password is forgotten, the easiest way to
		re-gain access is to wipe and re-flash the chip. 
		',
	'system.new_admin_pw' => 'New admin pass.',
	'system.new_admin_pw2' => 'New pass., repeat',
	'system.old_admin_pw' => 'Old admin pass.',

	'uart.baud' => 'Baud rate',
	'uart.parity' => 'Parity',
	'uart.parity.none' => 'None',
	'uart.parity.odd' => 'Odd',
	'uart.parity.even' => 'Even',
	'uart.stop_bits' => 'Stop-bits',
	'uart.stop_bits.one' => 'One',
	'uart.stop_bits.one_and_half' => 'One and half',
	'uart.stop_bits.two' => 'Two',

	'apply' => 'Apply!',
	'enabled' => 'Enabled',
	'disabled' => 'Disabled',
	'yes' => 'Yes',
	'no' => 'No',
	'confirm' => 'OK',
	'form_errors' => 'Validation errors for:',
];
