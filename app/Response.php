<?php

namespace App;


final class Response  {

    const SUCCESS   = 'SUCCESS';
    const FAIL      = 'FAIL';
    const BAD_REQUEST = 'BAD_REQUEST';
    const UNPROCESSABLE_ENTITY = 'UNPROCESSABLE_ENTITY';
    const NOT_FOUND = 'NOT_FOUND';

    protected $status;
    protected $content;

    public function __construct($status, $content = []) {
        $this->status = $status;
        $this->content = $content;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getContent() {
        return $this->content;
    }

}
