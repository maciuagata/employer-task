<?php

namespace tests;

require_once("./src/index.php");
use PHPUnit\Framework\TestCase;

use src\Employer;

class EmployerTest extends TestCase {
    /**
     * @test
     */
    public function test_file_destination_exists() {
        $employer = new Employer("./src/Employers/employers.txt");
        $this->assertEquals('./src/Employers/employers.txt', $employer->get_text_file_destination());
    }
}