<?php

/*
Challenge 3: Use reflection to get access to Question::$answer from $e->getAnswer
*/

class Question
{
    private $answer = 42;

    public function __construct($e)
    {
        try {
            throw $e;
        } catch (Exception $e) {
            echo $e->getAnswer($this) . PHP_EOL;
        }
    }
}


// start editing here


//$ref = new ReflectionClass();

class AnswerException extends Exception
{
    public function getAnswer(Question $question): int
    {
        $reflectionQuestion = new ReflectionObject($question);
        $reflectionQuestion->newInstanceWithoutConstructor();
        $value = $reflectionQuestion->getProperty('answer');
        $value->setAccessible(true);
        return $value->getValue($question);
    }
}
$e = new AnswerException();

// end editing here

new Question($e);

