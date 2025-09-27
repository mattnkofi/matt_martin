<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 */
class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // Get user records with optional search and pagination (Fixed: conditional search, safety casts)
    public function page($q, $records_per_page = null, $page = null)
    {
        // If no page is provided, return all users
        if (is_null($page)) {
            return $this->db->table($this->table)->get_all();
        } else {
            // Start query on users table
            $query = $this->db->table($this->table);

            // Add search only if $q is not empty (for id, first name, last name, or email)
            if (!empty($q)) {
                $query->like('id', '%' . $q . '%')
                    ->or_like('first_name', '%' . $q . '%')
                    ->or_like('last_name', '%' . $q . '%')
                    ->or_like('email', '%' . $q . '%');
            }

            // Copy query to count total matching rows
            $countQuery = clone $query;

            // Get total number of rows that match the search
            $countResult = $countQuery->select_count('*', 'count')->get();
            $data['total_rows'] = (int)($countResult['count'] ?? 0); // Safety cast and default

            // Get records for the current page
            $data['records'] = $query->pagination($records_per_page, $page)
                ->get_all();

            // Return total rows and page records
            return $data;
        }
    }

    // Insert new user (added to support controller; compatible with base Model)
    public function insert($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // Update user by ID (added; compatible signature with optional soft-delete param)
    public function update($id, $data, $with_deleted = false) {
        $updateQuery = $this->db->table($this->table)->where($this->primary_key, $id);
        return $updateQuery->update($data);
    }

    // Delete user by ID (added; compatible signature with optional soft-delete param)
    public function delete($id, $with_deleted = false) {
        $deleteQuery = $this->db->table($this->table)->where($this->primary_key, $id);
        return $deleteQuery->delete();
    }
}
