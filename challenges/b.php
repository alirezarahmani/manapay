<?php

/*
Challenge 2: Implement AnswerInterface and get Question to echo "4".
*/

class Question
{
    public function __construct(AnswerInterface $answer)
    {
        echo "What is 2 + 2?\n";
        $answer = $answer->get()->the()->answer();

        if ($answer instanceof AnswerInterface) {
            echo $answer . PHP_EOL;
        }
    }
}

interface AnswerInterface
{
    public function get();
    public function the();
    public function answer();
}

// start editing here

class Answer implements AnswerInterface
{
    private $response;

    public function __construct(int $answer = 4)
    {
        $this->response = $answer;
    }

    public function get(): self
    {
        return $this;
    }

    public function the(): self
    {
        return $this;
    }

    public function answer(): self
    {
        return $this;
    }

    public function __toString():string
    {
        return  $this->response;
    }

}

// end editing here

$answer = new Answer;
$question = new Question($answer);

