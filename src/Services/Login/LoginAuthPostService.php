<?php

namespace Src\Services\Login;

use Core\Post;
use Core\Session;

class LoginAuthPostService
{
    private  $post;
    private  $session;

    public function __construct(Session $session, Post $post)
    {   
        $this->session = $session;
        $this->post = $post;
    }

    public function serviceDataClear()
    {   
        if ($this->post->has('fullname') && $this->post->has('password')) {
            $this->post->add('employee', $_POST);
            $newPostData = clenFeilds($this->post->get('employee'));

            if (empty($newPostData)) {
                    $this->session->add('error', 'One of the field is incorrect fill!');
            } else {
                return $newPostData;
            }
        }
    }
}