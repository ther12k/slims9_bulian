<?php
/**
 * Copyright (C) 2007,2008  Arie Nugraha (dicarve@yahoo.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

/* Master File module submenu items */
// IP based access limitation
do_checkIP('smc');
do_checkIP('smc-masterfile');

$menu[] = array('Header', __('Master Files'));
$menu[] = array(__('Authors'), MWB.'master_file/author.php', __('Document Authors'));
$menu[] = array(__('Subjects'), MWB.'master_file/topic.php', __('Subject'));
$menu[] = array(__('Publishers'), MWB.'master_file/publisher.php', __('Document Publisher'));
$menu[] = array(__('Suppliers'), MWB.'master_file/supplier.php', __('Item Supplier'));
$menu[] = array(__('Locations'), MWB.'master_file/location.php', __('Item Location'));
$menu[] = array(__('GMD'), MWB.'master_file/index.php', __('General Material Designation'));
$menu[] = array(__('Collection Types'), MWB.'master_file/coll_type.php', __('Collection Type'));
$menu[] = array(__('Places'), MWB.'master_file/place.php', __('Place Name'));
$menu[] = array(__('Item Status'), MWB.'master_file/item_status.php', __('Item Status'));
$menu[] = array(__('Doc. Languages'), MWB.'master_file/doc_language.php', __('Document Content Language'));
$menu[] = array(__('Frequencies'), MWB.'master_file/frequency.php', __('Frequency'));
$menu[] = array('Header', __('Tools'));
$menu[] = array(__('Labels'), MWB.'master_file/label.php', __('Special Labels for Titles to Show Up On Homepage'));
$menu[] = array(__('Visitor Room'), MWB.'master_file/visitor_room.php', __('List of members comment about biblio'));
$menu[] = array(__('Comment Management'), MWB.'master_file/detail_comment.php', __('List of members comment about biblio'));
$menu[] = array(__('Cataloging Servers'), MWB.'master_file/p2pservers.php', __('List of available Copy Cataloging Servers'));
$menu[] = array(__('Item Code Pattern'), MWB.'master_file/item_code_pattern.php', __('Manage item code pattern'));
