<?php


function bl(int $number = 1) { // bl => break line

    $total = "";

    for ($i=0; $i < $number; $i++) { 
        $total .= "\n";
    }

    echo $total;
}

function message(string $message = '') {

    return new class ($message)
    {
        private $message;

        public function __construct($message)
        {
            $this->message = $message;
        }

        public function setMessage(string $setMessage)
        {
            $this->message = $setMessage;
            return $this;
        }

        public function getMessage()
        {
            return $this->message;
        }
    };
}

bl();

echo message('message')->getMessage();
bl();
echo message()->setMessage('setMessage')->getMessage();
bl();
echo message('message')->setMessage('setMessage')->getMessage();

bl(2);

/*
message
setMessage
setMessage
*/
