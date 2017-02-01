<?php
/*
 * darkstat_redirect.php
 *
 * part of pfSense (https://www.pfsense.org)
 * Copyright (c) 2017 Rubicon Communications, LLC (Netgate)
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

require_once("config.inc");
global $config;

// Protocol and port
$proto = $config['system']['webgui']['protocol'];
if (is_array($config['installedpackages']['darkstat'])) {
	$darkstat_config = $config['installedpackages']['darkstat']['config'][0];
} else {
	$darkstat_config = array();
}
$port= $darkstat_config['port'] ?: '666';

// Hostname
$httphost = getenv("HTTP_HOST");
$colonpos = strpos($httphost, ":");
if ($colonpos) {
	$baseurl = substr($httphost, 0, $colonpos);
} else {
	$baseurl = $httphost;
}

// Final redirect URL
$url = "{$proto}://{$baseurl}:{$port}";
header("Location: {$url}");

?>
