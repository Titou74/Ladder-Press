<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class GamesAdministration extends WP_List_Table
{
    public function gamesMenu()
    {
        if(!isset($_GET['action'])) {
            $gamesAdministration = new GamesAdministration();
            $gamesAdministration->prepare_items();

            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/listGames.php';
        } else if($_GET['action'] == "add") {
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editGame.php';
        } else if($_GET['action'] == "edit" && isset ($_GET['gameId'])) {
            $editGame = Game::getGameById($_GET['gameId']);
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editGame.php';
        } else if($_GET['action'] == "remove") {
            
        }
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
        
        $allGames = Game::getAllGames();
        
        $data = self::table_data($allGames);
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
            'cb'        => '<input type="checkbox" />',
            'id'          => 'ID',
            'name'       => 'Name',
            'short_name' => 'Short name',
            'guid'        => 'GUID require',
            'regex'    => 'GUID regex'
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
            'name' => array('name', false),
            'short_name' => array('short_name', false),
        );
    }
    
    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data($allGames)
    {
        $data = array();
        foreach ($allGames as $game) {
            $dataGame = array(
                'id'          => $game->getId(),
                'name'       => $game->getName(),
                'short_name' => $game->getShortname(),
                'guid'        => $game->getActiveGuid() ? 'Yes' : 'No',
                'regex'    => $game->getGuidRegex()
            );
            $data[] = $dataGame;
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
            case 'name':
            case 'short_name':
            case 'guid':
            case 'regex':
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
    
    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }
    
    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="book[]" value="%s" />', $item['ID']
        );    
    }
}
