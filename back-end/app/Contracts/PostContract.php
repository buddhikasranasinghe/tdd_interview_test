<?php

namespace App\Contracts;

interface PostContract
{
    public function addPost(array $postData);
    public function getSubscribeUsers(int $websiteId);
    public function sendMails(array $mailContent, array $users);
}
