<?php

namespace App;


class Match {
    private $user_id;
    private $user_name;
    private $fieldMatches;
    private $schoolMatches;
    private $totalMatches;
    private $highSchool;
    private $degrees;
    private $avatar;
    private $allowMessage;

    public function __construct($user_id, $user_name, $avatar, $degreeMatches, $fieldMatches, $schoolMatches, $highSchoolMatch, $highSchool, $allowMessage) {
        $this->user_id       = $user_id;
        $this->user_name     = $user_name;
        $this->fieldMatches  = $fieldMatches;
        $this->schoolMatches = $schoolMatches;
        $this->degrees       = $degreeMatches;
        $this->avatar        = $avatar;
        $this->allowMessage  = $allowMessage;

        if($highSchoolMatch) {
            $this->highSchool  = $highSchool;
        }
        $this->totalMatches    = count($fieldMatches) + count($schoolMatches);
    }

    public function __get($property) {
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }
}