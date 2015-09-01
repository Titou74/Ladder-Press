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
        if(!isset($_GET['teamId'])) die("TRACE ! Pas d'id de team :-/ ");
        include_once plugin_dir_path( __FILE__ ).'../../model/LineUp.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/Game.php';
        if (isset($_POST['submit'])) {
            if(isset($_POST['ladder_press_remove_map_id']) && $_POST['ladder_press_remove_map_id'] != 0) {
                // Remove line up
                Map::deleteMap($_POST['ladder_press_remove_map_id']);
            } else if (isset($_POST['ladder_press_lineup_id'])) {
                if($_POST['ladder_press_lineup_id'] != 0) {
                    // Update line up 
                    $LUP = LineUp::getLineUpById($_POST['ladder_press_lineup_id']);
                    $LUP->setName($_POST['ladder_press_lineup_name']);
                    $LUP->setTeamId($_POST['ladder_press_lineup_team_id']);
                    $LUP->setGameId($_POST['ladder_press_lineup_for_game']);
                    $LUP->setDateCreation($_POST['ladder_press_lineup_creation']);
                    $LUP->setShortName($_POST['ladder_press_lineup_shortname']);
                    $LUP->setShortName($_POST['ladder_press_lineup_shortname']);
                    if($_POST['ladder_press_lineup_active'] == "on" || $_POST['ladder_press_lineup_active'])
                        $LUP->setActive(1);
                    else
                        $LUP->setActive (0);
                    LineUp::updateLineUp($LUP);
                } else {
                    $LUP = new LineUp();
                    $LUP->setName($_POST['ladder_press_lineup_name']);
                    $LUP->setTeamId($_POST['ladder_press_lineup_team_id']);
                    $LUP->setGameId($_POST['ladder_press_lineup_for_game']);
                    $LUP->setDateCreation($_POST['ladder_press_lineup_creation']);
                    $LUP->setShortName($_POST['ladder_press_lineup_shortname']);
                    $LUP->setShortName($_POST['ladder_press_lineup_shortname']);
                    if($_POST['ladder_press_lineup_active'] == "on" || $_POST['ladder_press_lineup_active'])
                        $LUP->setActive(1);
                    else
                        $LUP->setActive(0);
                    LineUp::createLineUp($LUP);
                }

            }
        }
        
        if(!isset($_GET['action']) || (isset($_GET['action']) && $_GET['action'] == "view_lineup")) {
            $linesUpAdministration = new LinesUpAdministration();
            $linesUpAdministration->prepare_items();         
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/listLinesUp.php';
        } else if($_GET['action'] == "add") {
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editLineUp.php';
        } else if($_GET['action'] == "edit" && isset ($_GET['lineUpId'])) {
            $editLUP = LineUp::getLineUpById($_GET['lineUpId']);
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editLineUp.php';
        } //else if($_GET['action'] == "remove" && isset ($_GET['mapId'])) {
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
        
        $LUPsTeam = LineUp::getLinesUpByTeamId($_GET['teamId']);
        $data = self::table_data($LUPsTeam);
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
            'active'     => 'Active',
            'action'     => ''
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
    private function table_data($LUPsTeam) // LUP stands for LinesUp
    {
        $data = array();
        foreach ($LUPsTeam as $LUP) {
            $game = Game::getGameById($LUP->getGameId());
            $dataLUP = array(
                'id'        => $LUP->getId(),
                'game'      => $game->getName(),
                'name'      => $LUP->getName(),
                'short_name'   => $LUP->getShortName(),
                'date_crea'   => $LUP->getDateCreation(),
                'active'        => $LUP->getActive() ? 'Yes' : 'No',
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
            'edit' => sprintf('<a href="?page=ladder_press_teams_linesup&action=edit&lineUpId='.$item["id"].'&teamId='.$_GET['teamId'].'">Edit</a>'),
            'delete' => sprintf('<a href="?page=ladder_press_teams_linesup&action=remove&lineUpId='.$item["id"].'&teamId='.$_GET['teamId'].'">Delete</a>'),
        );
        return sprintf('%1$s %2$s', $item['Name'], $this->row_actions($actions) );
    }
    
}
