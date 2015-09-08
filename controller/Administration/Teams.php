<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class TeamsAdministration extends WP_List_Table
{
    public function teamsMenu()
    {
        // Check if user is admin
        if(! is_admin()) exit;
        
        // Include require models
        include_once plugin_dir_path( __FILE__ ).'../../model/Team.php';
        
        if (isset($_POST['submit'])) {
            if(isset($_POST['ladder_press_remove_team_id']) && $_POST['ladder_press_remove_team_id'] != 0) {
                // Remove game
                Team::deleteTeam($_POST['ladder_press_remove_team_id']);
            } else if (isset($_POST['ladder_press_team_id'])) {
                if($_POST['ladder_press_team_id'] != 0) {
                    // Update game
                    $team = Team::getTeamById($_POST['ladder_press_team_id']);
                    $team->setDateCrea($_POST['ladder_press_team_creation']);
                    if($_POST['ladder_press_team_active'] == "on" || $_POST['ladder_press_team_active'])
                        $team->setActive(1);
                    else
                        $team->setActive (0);
                    $team->setName($_POST['ladder_press_team_name']);
                    $team->setTag($_POST['ladder_press_team_tag']);
                    $team->setIdCreator($_POST['ladder_press_team_creator']);
                    $team->setSite($_POST['ladder_press_team_site']);
                    if(isset($_FILES['ladder_press_team_logo']) && $_FILES['ladder_press_team_logo'] != '')
                    {
                        $uploadedFile = $_FILES['ladder_press_team_logo'];
                        $uploadOverrides = array( 'test_form' => false );
                        $movefile = wp_handle_upload($uploadedFile,$uploadOverrides);
                        if ( $movefile ) {
                            $wp_filetype = $movefile['type'];
                            $filename = $movefile['file'];
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
                                'post_mime_type' => $wp_filetype,
                                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );
                            $attach_id = wp_insert_attachment( $attachment, $filename);
                        }
                        $logo_name = $attach_id;
                    }else{
                        $logo_name = "";
                    }  
                    $team->setLogoName($logo_name);
                    Team::updateTeam($team);
                } else {
                    // Create game
                    $team = new Team();
                    $team->setDateCrea($_POST['ladder_press_team_creation']);
                    if($_POST['ladder_press_team_active'] == "on" || $_POST['ladder_press_team_active'])
                        $team->setActive(1);
                    else
                        $team->setActive (0);
                    $team->setName($_POST['ladder_press_team_name']);
                    $team->setTag($_POST['ladder_press_team_tag']);
                    $team->setIdCreator($_POST['ladder_press_team_creator']);
                    $team->setSite($_POST['ladder_press_team_site']);
                    if(isset($_FILES['ladder_press_team_logo']) && $_FILES['ladder_press_team_logo'] != '')
                    {
                        $uploadedFile = $_FILES['ladder_press_team_logo'];
                        $uploadOverrides = array( 'test_form' => false );
                        $movefile = wp_handle_upload($uploadedFile,$uploadOverrides);
                        if ( $movefile ) {
                            $wp_filetype = $movefile['type'];
                            $filename = $movefile['file'];
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
                                'post_mime_type' => $wp_filetype,
                                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );
                            $attach_id = wp_insert_attachment( $attachment, $filename);
                        }
                        $logo_name = $movefile['url'];
                    }else{
                        $logo_name = "";
                    }  
                    $team->setLogoName($logo_name);
                    Team::createTeam($team);
                }
                
            }
        }
        
        if(!isset($_GET['action'])) {
            $teamsAdministration = new TeamsAdministration();
            $teamsAdministration->prepare_items();
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/listTeams.php';
        } else if($_GET['action'] == "add") {
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editTeam.php';
        } else if($_GET['action'] == "edit" && isset ($_GET['teamId'])) {
            $editTeam = Team::getTeamById($_GET['teamId']);
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/editTeam.php';
        } else if($_GET['action'] == "remove" && isset ($_GET['teamId'])) {
            $deleteTeam = Team::getTeamById($_GET['teamId']);
            include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/deleteTeam.php';
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
        
        $allTeams = Team::getAllTeams();
        $data = self::table_data($allTeams);
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
            'id'          => 'ID',
            'name'       => 'Name',
            'tag'        => 'Tag',
            'id_creator'        => 'Creator',
            'date_creation'    => 'Creating date',
            'active'    => 'Active',
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
            'name' => array('name', false),
            'tag' => array('tag', false),
            'id_creator' => array('id_creator', false),
            'date_creation' => array('date_creation', false),
            'active' => array('active', false)
        );
    }
    
    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data($allTeams)
    {
        $data = array();
        foreach ($allTeams as $team) {
            $user_info = get_userdata($team->getIdCreator());    
            $dataTeam = array(
                'id'          => $team->getId(),
                'name'       => $team->getName(),
                'tag'        => $team->getTag(),
                'id_creator'        => $user_info->display_name,
                'date_creation'        => $team->getDateCrea(),
                'active'        => $team->getActive() ? 'Yes' : 'No'
            );
            $data[] = $dataTeam;
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
            case 'tag':
            case 'id_creator':
            case 'date_creation':
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
    
    /*function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }*/
    
    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="book[]" value="%s" />', $item['ID']
        );    
    }
    
    function column_action($item) {
        $actions = array(
            'edit' => sprintf('<a href="?page=ladder_press_teams&action=edit&teamId='.$item["id"].'">Edit</a>'),
            'delete' => sprintf('<a href="?page=ladder_press_teams&action=remove&teamId='.$item["id"].'">Delete</a>'),
            'view_lineup' => sprintf('<a href="?page=ladder_press_teams_linesup&action=view_lineup&teamId='.$item["id"].'">View lineup</a>')
        );
        return sprintf('%1$s %2$s', $item['Name'], $this->row_actions($actions) );
    }
}
