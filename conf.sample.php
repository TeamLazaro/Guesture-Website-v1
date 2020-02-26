<?php
/*
 *
 * This is a sample configuration file.
 * You'll have to clone this file, and name that `conf.php`. Then set proper values for these constants.
 * If you don't know what values to plonk in here, check with @adi or search the Development folder for this project on DropBox.
 *
 */

/**
 * General
 *
 */
const HTTPS_SUPPORT = false;

/**
 * Content Management System (CMS)
 *
 */
// Enable the CMS?
const CMS_ENABLED = true;

// Set debug mode and log errors
const CMS_DEBUG_MODE = true;
const CMS_DEBUG_LOG_TO_FILE = false;
const CMS_DEBUG_LOG_TO_FRONTEND = true;

// Should the CMS auto-update?
const CMS_AUTO_UPDATE = false;

// Should the media be fetched from a remote server?
const CMS_FETCH_MEDIA_REMOTELY = true;
// The address of the remote server
// ( exclude the protocol and trailing slash from the URL )
const CMS_REMOTE_ADDRESS = '<check dropbox>';

// Database
const CMS_USE_SQLITE = false;
const CMS_DB_HOST = '<check dropbox>';
const CMS_DB_NAME = '<check dropbox>';
const CMS_DB_USER = '<check dropbox>';
const CMS_DB_PASSWORD = '<check dropbox>';
