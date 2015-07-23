<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class MPacksAdministration extends WP_List_Table
{
    public function mPacksMenu()
    {
        if(! is_admin()) exit;
        include_once plugin_dir_path( __FILE__ ).'../../model/Map.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/MapPack.php';
        
        if (isset($_POST['submit'])) {
            if(isset($_POST['ladder_press_remove_m_pack_id']) && $_POST['ladder_press_remove_m_pack_id'] != 0) {
                // Remove map
                MapPack::deleteMapPack($_POST['ladder_press_remove_m_pack_id']);
            } else if (isset($_POST['ladder_press_m_pack_id'])) {
                if($_POST['ladder_press_m_pack_id'] != 0) {
                    // Update game   
                    $mPack = MapPack::getMapPackById($_POST['ladder_press_m_pack_id']);
                    $mPack->setName($_POST['ladder_press_m_pack_name']);
                    MapPack::updateMapPack($mPack);
                    $mPack->deleteMapsInMapPack($mPack->getId());
                    $maps = $_POST['ladder_press_m_pack_maps'];
                    foreach($maps as $map)
                    {
                        $uneMap = Map::getMapById($map);
                        $lesMaps[] = $uneMap;
                    }
                    MapPack::addMapsInMapPack($lesMaps,$mPack);
                } else {
                    $mPack = new MapPack();
                    $mPack->setName($_POST['ladder_press_m_pack_name']);
                    $idMapPackCreated = MapPack::createMapPack($mPack);
                    $leMapPack = MapPack::getMapPackById($idMapPackCreated);
                    $maps = $_POST['ladder_press_m_pack_maps'];
                    foreach($maps as $map)
                    {
                        $uneMap = Map::getMapById($map);
                        $lesMaps[] = $uneMap;
                    }
                    MapPack::addMapsInMapPack($lesMaps,$leMapPack);
                }

            }
        }
        if(!isset($_GET['action'])) {
            $mPacksAdministration = new MPacksAdministration();
            $mPacksAdministration->prepare_items();
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/listMapPacks.php';
        } else if($_GET['action'] == "add") {
            wp_enqueue_script('jquery');
            wp_enqueue_script( 'editMapPacks', plugins_url( '/../../view/js/'.'editMapPacks.js', __FILE__) , array('jquery'), '1.0.0', true );
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editMapPack.php';
        } else if($_GET['action'] == "edit" && isset ($_GET['mPackId'])) {
            $editMapPack = MapPack::getMapPackById($_GET['mPackId']);
            wp_enqueue_script('jquery');
            wp_enqueue_script( 'editMapPacks', plugins_url( '/../../view/js/'.'editMapPacks.js', __FILE__) , array('jquery'), '1.0.0', true );
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editMapPack.php';
        } else if($_GET['action'] == "remove" && isset ($_GET['mPackId'])) {
            $deleteMapPack = MapPack::getMapPackById($_GET['mPackId']);
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/deleteMapPack.php';
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
        
        $allMPacks = MapPack::getAllMapPacks();
        
        $data = self::table_data($allMPacks);
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
            'name'       => 'Name',
            'maps'       => 'Maps',
            'action'    => ''
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
            'name' => array('name', false)
        );
    }
    
    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data($allMPacks)
    {
        $data = array();
        foreach ($allMPacks as $mPack) {
            $listmap='';
            $maps = Map::getMapsByMapPack($mPack->getId());
            foreach ($maps as $map)
            {
                $listmap .= $map->getName().'<br/>';
            }
            $dataMap = array(
                'id'        => $mPack->getId(),
                'name'      => $mPack->getName(),
                'maps'      => $listmap
            );
            $data[] = $dataMap;           
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
            case 'maps':
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
            'edit' => sprintf('<a href="?page=ladder_press_m_packs&action=edit&mPackId='.$item["id"].'">Edit</a>'),
            'delete' => sprintf('<a href="?page=ladder_press_m_packs&action=remove&mPackId='.$item["id"].'">Delete</a>'),
        );
        return sprintf('%1$s %2$s', $item['Name'], $this->row_actions($actions) );
    }
    
}