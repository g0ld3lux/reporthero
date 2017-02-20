<?php

namespace Reporthero\Http\Requests;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TemplateFilters
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function byName()
    {
        return $name = $this->request->input('name');
    }

    public function byHtml()
    {
        return $html = $this->request->input('html');
    }

    protected function isJson($string) {
    return !preg_match('/[^,:{}\\[\\]0-9.\\-+Eaeflnr-u \\n\\r\\t]/',
       preg_replace('/"(\\.|[^"\\\\])*"/', '', $string));
    
    }

    public function byContext()
    {
       $context = $this->request->input('context');

       if($this->isJson($context))
       {
         return $context = json_decode($context);  
       }
    }

    public function byFromEmail()
    {
        $email = $this->request->input('from_email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return $email;
        }
    }

    public function byFromName()
    {
        return $name = $this->request->input('from_name');
    }

    public function bySubject()
    {
        return $subject = $this->request->input('subject');
    }

    public function byTo()
    {
        return $arg = $this->request->input('to');
        if($this->isJson($arg))
       {
         return $arg = json_decode($arg);
       }
    }

}
