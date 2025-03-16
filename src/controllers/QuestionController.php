<?php

require_once '../models/Question.php';

class QuestionController {
    private $questionModel;

    public function __construct() {
        $this->questionModel = new Question();
    }

    public function create($title, $body) {
        return $this->questionModel->create($title, $body);
    }

    public function read($id) {
        return $this->questionModel->read($id);
    }

    public function update($id, $title, $body) {
        return $this->questionModel->update($id, $title, $body);
    }

    public function delete($id) {
        return $this->questionModel->delete($id);
    }

    public function readAll() {
        return $this->questionModel->readAll();
    }
}