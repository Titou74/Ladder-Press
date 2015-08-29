<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class LinesUpAdministration extends WP_List_Table
{
    public function linesUpMenu()
    {
        if(! is_admin()) exit;
        include_once plugin_dir_path( __FILE__ ).'../../model/LineUp.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/Game.php';
//        if (isset($_POST['submit'])) {
//            if(isset($_POST['ladder_press_remove_map_id']) && $_POST['ladder_press_remove_map_id'] != 0) {
//                // Remove map
//                Map::deleteMap($_POST['ladder_press_remove_map_id']);
//            } else if (isset($_POST['ladder_press_map_id'])) {
//                if($_POST['ladder_press_map_id'] != 0) {
//                    // Update game
//                    if(isset($_FILES['pick']) && $_FILES['pick'] != '')
//                    {
//                        $uploadedFile = $_FILES['pick'];
//                        $uploadOverrides = array( 'test_form' => false );
//                        $movefile = wp_handle_upload($uploadedFile,$uploadOverrides);
//                        $url_pick = $movefile['url'];
//                    }else{
//                        $url_pick = "";
//                    }     
//                    $map = Map::getMapById($_POST['ladder_press_map_id']);
//                    $map->setName($_POST['ladder_press_map_name']);
//                    $map->setGameId($_POST['ladder_press_map_from_game']);
//                    $map->setPick($url_pick);
//                    Map::updateMap($map);
//                } else {
//                    // Create game
//                    if(isset($_FILES['pick']) && $_FILES['pick'] != '')
//                    {
//                        $uploadedFile = $_FILES['pick'];
//                        $uploadOverrides = array( 'test_form' => false );
//                        $movefile = wp_handle_upload($uploadedFile,$uploadOverrides);
//                        $url_pick = $movefile['url'];
//                    }else{
//                        $url_pick = "";
//                    }
//                    $map = new Map();
//                    $map->setName($_POST['ladder_press_map_name']);
//                    $map->setGameId($_POST['ladder_press_map_from_game']);
//                    $map->setPick($url_pick);
//                    Map::createMap($map);
//                }
//
//            }
//        }
        if(isset($_GET['action']) && $_GET['action'] == "view_lineup" && isset($_GET['teamId'])) {
            $linesUpAdministration = new LinesUpAdministration();
            $linesUpAdministration->prepare_items();         
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/viewLineUp.php';
        } //else if($_GET['action'] == "add") {
//            require_once( ABSPATH . 'wp-admin/includes/image.php' );
//            require_once( ABSPATH . 'wp-admin/includes/file.php' );
//            require_once( ABSPATH . 'wp-admin/includes/media.php' );
//            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editMap.php';
//        } else if($_GET['action'] == "edit" && isset ($_GET['mapId'])) {
//            $editMap = Map::getMapById($_GET['mapId']);
//            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editMap.php';
//        } else if($_GET['action'] == "remove" && isset ($_GET['mapId'])) {
//            $deleteMap = Map::getMapById($_GET['mapId']);
//            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/deleteMap.php';
//        }
    }
    
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = self::get_columns();
        $hidden = self::get_hidden_columns(); 
        $sortable = self::get_sortable_columns();
        
        $allLinesUp = LineUp::getAllLinesUp();
        $data = self::table_data($allLinesUp);
        usort( $data, array( &$this, 'sort_data' ) );
        
        $perPage = 20;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }
    
    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id'         => 'ID',
            'game'       => 'Game',
            'name'       => 'Name',
            'short_name' => 'Short Name',
            'date_crea'  => 'Creation date',
            'active'     => 'Active'
        );
        return $columns;
    }
    
    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array(); // CAN BE array('name', 'regex');
    }
    
    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array(
            'id' => array('id', false),
            'game' => array('game', false),
            'name' => array('name', false),
            'date_crea' => array('date_crea',false),
            'active' => array('date_crea',false), 
        );
    }
    
    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data($allLUP) // LUP stands for LinesUp
    {
        $data = array();
        foreach ($allLUP as $LUP) {
            $game = Game::getGameById($LUP->getGameId());
            $dataLUP = array(
                'id'        => $LUP->getId(),
                'game'      => $game->getName(),
                'name'      => $LUP->getName(),
                'short_name'   => $LUP->getShortName(),
                'date_crea'   => $LUP->getDateCreation(),
                'active'        => $LUP->getActive() ? 'Yes' : 'No'
            );
            $data[] = $dataLUP;           
        }
        return $data;
    }
    
    // Used to display the value of the id column
    public function column_id($item)
    {
        return $item['id'];
    }
    
    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'game':
            case 'name':
            case 'short_name':
            case 'date_crea':
            case 'active':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }
    
    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'title';
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }

        $result = strnatcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }
    
    function column_action($item) {
        $actions = array(
            'edit' => sprintf('<a href="?page=ladder_press_maps&action=edit&mapId='.$item["id"].'">Edit</a>'),
            'delete' => sprintf('<a href="?page=ladder_press_maps&action=remove&mapId='.$item["id"].'">Delete</a>'),
        );
        return sprintf('%1$s %2$s', $item['Name'], $this->row_actions($actions) );
    }
    
}
