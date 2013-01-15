<?php
/**
 * GForge HTTP 404 (Document Not Found) Page
 *
 * Copyright 1999-2001 (c) VA Linux Systems
 *
 * @version   $Id: 404.php 3442 2004-10-08 21:39:22Z gsmet $
 *
 * This file is part of GForge.
 *
 * GForge is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GForge is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GForge; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

require_once('pre.php');    // Initial db and session library, opens session

$HTML->header(array('title'=>$Language->getText('error','title')));

echo "<div class=\"warning\">";

$host = $_SERVER['HTTP_HOST'];
if (session_issecure()) {
	echo '<h2><a href="https://'.$host.'">';
} else {
	echo '<h2><a href="http://'.$host.'">';
}

echo $Language->getText('error','not_found')."</a></h2>";

echo $HTML->searchBox();

echo "</div>";

$HTML->footer(array());

?>
