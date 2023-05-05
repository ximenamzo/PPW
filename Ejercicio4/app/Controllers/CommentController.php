<?php

    namespace Controllers;

    use Models\posts;
    use Models\comments;
    use Controllers\auth\LoginController as LoginController;

    class CommentController{
		private $userId;
		private $title;
		private $body;

		public function __construct(){
			$ua = new LoginController();
			$ua->sessionValidate();
			$this->userId = $ua->id;
		}

		public function checkComments($limit="", $pid = ""){
			$comments = new comments();
			$result = $comments->where([['postId', $pid]])->get();
            return $result;
		}

    }