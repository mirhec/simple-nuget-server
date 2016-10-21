<?php
// Package was hit directly (ie. request to /id/version). Currently we only
// expect these to be DELETE requests.

require(__DIR__ . '/../inc/core.php');

if (request_method() !== 'DELETE') {
	api_error('405', 'Only DELETEs allowed here');
}

require_auth();

$package = str_replace($_SERVER['REWRITE_BASE'], '', $_SERVER['REQUEST_URI']);
list($id, $version) = explode('/', $package);
$path = get_package_path($id, $version);

if (file_exists($path)) {
	unlink($path);
}

DB::deleteVersion($id, $version);
