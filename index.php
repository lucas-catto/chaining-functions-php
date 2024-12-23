<?php

// each method returns an anonymous object
function crud() {

    return new class { // anonymous object

        private $items = [];

        public function create() {
            echo "create\n";
            return $this;
        }

        public function read() {
            echo "read\n";
            return $this;
        }

        public function update() {
            echo "update\n";
            return $this;
        }

        public function delete() {
            echo "delete\n";
            return $this;
        }
    };
}

crud()->create()->read()->update()->delete();
