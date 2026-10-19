<?php
// This file is part of Moodle - http://moodle.org/

define('CLI_SCRIPT', true);

require(dirname(__DIR__, 3) . '/config.php');
require_once($CFG->libdir . '/blocklib.php');

$context = context_course::instance(SITEID);
if ($DB->record_exists('block_instances', [
    'blockname' => 'catalogo_publico',
    'parentcontextid' => $context->id,
    'pagetypepattern' => 'site-index',
])) {
    echo "The catalogue showcase block is already positioned on the front page.\n";
    exit(0);
}

// Remove the early test instance created in the system context, if present.
$systemcontext = context_system::instance();
if ($legacy = $DB->get_record('block_instances', [
    'blockname' => 'catalogo_publico',
    'parentcontextid' => $systemcontext->id,
    'pagetypepattern' => 'site-index',
])) {
    blocks_delete_instance($legacy);
}

$page = new moodle_page();
$page->set_context($context);
$page->set_course(get_site());
$page->set_pagetype('site-index');
$page->blocks->add_region('catalogo');
$page->blocks->add_block('catalogo_publico', 'catalogo', 0, false, 'site-index');

echo "The catalogue showcase block was added to the front-page catalogue region.\n";
