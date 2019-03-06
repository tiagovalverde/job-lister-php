<?php

class Job {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // get all jobs
    public function getAllJobs() {
        $this->db->query("SELECT jobs.*, categories.name AS cname 
                          FROM jobs
                          INNER JOIN categories
                          ON jobs.category_id = categories.id
                          ORDER BY post_date DESC");
        // assign result set
        $results = $this->db->resultSet();
        return $results;
    } 

    public function getCategories() {
        $this->db->query("SELECT * FROM categories");
        // assign result set
        $results = $this->db->resultSet();
        return $results;
    }

    public function getJobsByCategory($category) {
        $this->db->query("SELECT jobs.*, categories.name AS cname 
                          FROM jobs
                          INNER JOIN categories
                          ON jobs.category_id = categories.id
                          WHERE jobs.category_id = $category 
                          ORDER BY post_date DESC");
        // assign result set
        $results = $this->db->resultSet();
        return $results;
    }

    public function getCategory($category_id) {
        $this->db->query("SELECT * FROM categories WHERE id = :category_id"); 
        $this->db->bind(':category_id', $category_id);
        // assign the row
        $row = $this->db->single();
        
        return $row;
    }

    public function getJob($id) {
        $this->db->query("SELECT * FROM jobs WHERE id = :id"); 
        $this->db->bind(':id', $id);
        // assign the row
        $row = $this->db->single();
        
        return $row;
    }

    public function createJob($data) {
        $this->db->query("INSERT INTO jobs 
                         (company, category_id, title, description,
                         location, salary, contact_email, contact_user)
                         VALUES 
                         (:company, :category_id, :title, :description,
                         :location, :salary, :contact_email, :contact_user)");
        $this->db->bind(':company', $data['company']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':salary', $data['salary']);
        $this->db->bind(':contact_email', $data['contact_email']);
        $this->db->bind(':contact_user', $data['contact_user']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

}