<?php

namespace src;

require_once('./src/Storage.php');
require_once('./src/JobCandidate.php');

class Employer {
    private $_text_file_destination;

    function __construct($text_file_destination) {
        $this->set_text_file_destination ($text_file_destination);
    }

    public function employ(Storage $storage, JobCandidate $jobCandidate) {
        
        //if jobCandidate is experienced, insert name into Storage or write name into a text file

        if ($jobCandidate->isExperienced()) {
            $storage->insert($jobCandidate->getName());
        }
        else {
            
            //check if name is not already written into a text file
            // escapeshellarg — escape a string to be used as a shell argument
            if(!exec('grep ' . escapeshellarg($jobCandidate->getName()) . ' ' . $this->_text_file_destination)) {
                file_put_contents(
                    $this->_text_file_destination,
                    $jobCandidate->getName() . PHP_EOL,
                    FILE_APPEND | LOCK_EX
                );
            }
        }
    }

    public function set_text_file_destination($_text_file_destination) {
        
        if (file_exists($_text_file_destination)) {
            $this->_text_file_destination = $_text_file_destination;
        }
    }

    public function get_text_file_destination() {
        return $this->_text_file_destination;
    }
}