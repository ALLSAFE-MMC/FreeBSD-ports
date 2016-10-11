<?php
/*
 * openvpn_connect_profile.php
 *
 * part of pfSense (https://www.pfsense.org)
 * Copyright (c) 2016 Rubicon Communications, LLC (Netgate)
 * All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require("guiconfig.inc");

$profileDir   = '/usr/local/libdata/vpn-profile';
$ovpnProfile = 'remote-access-openvpn.ovpn';

if (file_exists("$profileDir/$ovpnProfile")) {

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$ovpnProfile);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize("$profileDir/$ovpnProfile"));
	ob_clean();
	flush();
	readfile("$profileDir/$ovpnProfile");
} else {
	echo "OpenVPN profile $ovpnProfile does not exist\n";
}

exit;

?>
