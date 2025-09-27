<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
    }

    // Function for show.php (Fixed for server-side pagination)
    public function show(){
        // Get current page (default 1, validate as int)
        $page = 1;
        if (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) {
            $page = (int)$this->io->get('page');
            $page = max(1, $page); // Prevent negative/invalid pages
        }

        // Get search query
        $q = '';
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10; // number of users per page

        // Call model's pagination method (pass page number, not offset)
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Calculate total pages
        $total_pages = ceil($total_rows / $records_per_page);

        // Clamp current page to valid range (e.g., if direct link to invalid page)
        if ($page > $total_pages && $total_pages > 0) {
            $page = $total_pages;
        }

        // Send data to view (handle pagination links manually in view for UI consistency)
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['search'] = $q; // For preserving in links/form

        $this->call->view('show', $data);
    }

    // Function Create (unchanged)
    public function create() {
        if($this->io->method() == 'post'){
            $lastname = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email = $this->io->post('email');
            $data = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email
            );
            if($this->UserModel->insert($data)){
                redirect('users/show');
            } else {
                echo 'Something went wrong';
            }
        } else {
            $this->call->view('create');
        }
    }

    // Function Update (unchanged)
    public function update($id) {
        $data['user'] = $this->UserModel->find($id);
        if($this->io->method() == 'post'){
            $lastname = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email = $this->io->post('email');
            $data = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email
            );
            if($this->UserModel->update($id, $data)){
                redirect('users/show');
            } else {
                echo 'Something went wrong';
            }
        } else {
            $this->call->view('update', $data);
        }
    }

    // Function Delete (unchanged)
    public function delete($id){
        if($this->UserModel->delete($id)){
            redirect('users/show');
        } else {
            echo 'Something went wrong';
        }
    }
}
