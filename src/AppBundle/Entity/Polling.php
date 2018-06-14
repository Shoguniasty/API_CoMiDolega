<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Polling
 *
 * @ORM\Table(name="polling")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PollingRepository")
 */
class Polling
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answerA", type="string", length=255)
     */
    private $answerA;

    /**
     * @var string
     *
     * @ORM\Column(name="answerB", type="string", length=255)
     */
    private $answerB;

    /**
     * @var string
     *
     * @ORM\Column(name="answerC", type="string", length=255)
     */
    private $answerC;

    /**
     * @var string
     *
     * @ORM\Column(name="answerD", type="string", length=255)
     */
    private $answerD;

    /**
     * @var string
     *
     * @ORM\Column(name="pointA", type="string", length=255)
     */
    private $pointA;

    /**
     * @var string
     *
     * @ORM\Column(name="pointB", type="string", length=255)
     */
    private $pointB;

    /**
     * @var string
     *
     * @ORM\Column(name="pointC", type="string", length=255)
     */
    private $pointC;

    /**
     * @var string
     *
     * @ORM\Column(name="pointD", type="string", length=255)
     */
    private $pointD;

    /**
     * @var string
     *
     * @ORM\Column(name="hintIfA", type="string", length=255)
     */
    private $hintIfA;

    /**
     * @var string
     *
     * @ORM\Column(name="hintIfB", type="string", length=255)
     */
    private $hintIfB;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Polling
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answerA
     *
     * @param string $answerA
     *
     * @return Polling
     */
    public function setAnswerA($answerA)
    {
        $this->answerA = $answerA;

        return $this;
    }

    /**
     * Get answerA
     *
     * @return string
     */
    public function getAnswerA()
    {
        return $this->answerA;
    }

    /**
     * Set answerB
     *
     * @param string $answerB
     *
     * @return Polling
     */
    public function setAnswerB($answerB)
    {
        $this->answerB = $answerB;

        return $this;
    }

    /**
     * Get answerB
     *
     * @return string
     */
    public function getAnswerB()
    {
        return $this->answerB;
    }

    /**
     * Set answerC
     *
     * @param string $answerC
     *
     * @return Polling
     */
    public function setAnswerC($answerC)
    {
        $this->answerC = $answerC;

        return $this;
    }

    /**
     * Get answerC
     *
     * @return string
     */
    public function getAnswerC()
    {
        return $this->answerC;
    }

    /**
     * Set answerD
     *
     * @param string $answerD
     *
     * @return Polling
     */
    public function setAnswerD($answerD)
    {
        $this->answerD = $answerD;

        return $this;
    }

    /**
     * Get answerD
     *
     * @return string
     */
    public function getAnswerD()
    {
        return $this->answerD;
    }

    /**
     * Set pointA
     *
     * @param string $pointA
     *
     * @return Polling
     */
    public function setPointA($pointA)
    {
        $this->pointA = $pointA;

        return $this;
    }

    /**
     * Get pointA
     *
     * @return string
     */
    public function getPointA()
    {
        return $this->pointA;
    }

    /**
     * Set pointB
     *
     * @param string $pointB
     *
     * @return Polling
     */
    public function setPointB($pointB)
    {
        $this->pointB = $pointB;

        return $this;
    }

    /**
     * Get pointB
     *
     * @return string
     */
    public function getPointB()
    {
        return $this->pointB;
    }

    /**
     * Set pointC
     *
     * @param string $pointC
     *
     * @return Polling
     */
    public function setPointC($pointC)
    {
        $this->pointC = $pointC;

        return $this;
    }

    /**
     * Get pointC
     *
     * @return string
     */
    public function getPointC()
    {
        return $this->pointC;
    }

    /**
     * Set pointD
     *
     * @param string $pointD
     *
     * @return Polling
     */
    public function setPointD($pointD)
    {
        $this->pointD = $pointD;

        return $this;
    }

    /**
     * Get pointD
     *
     * @return string
     */
    public function getPointD()
    {
        return $this->pointD;
    }

    /**
     * Set hintIfA
     *
     * @param string $hintIfA
     *
     * @return Polling
     */
    public function setHintIfA($hintIfA)
    {
        $this->hintIfA = $hintIfA;

        return $this;
    }

    /**
     * Get hintIfA
     *
     * @return string
     */
    public function getHintIfA()
    {
        return $this->hintIfA;
    }

    /**
     * Set hintIfB
     *
     * @param string $hintIfB
     *
     * @return Polling
     */
    public function setHintIfB($hintIfB)
    {
        $this->hintIfB = $hintIfB;

        return $this;
    }

    /**
     * Get hintIfB
     *
     * @return string
     */
    public function getHintIfB()
    {
        return $this->hintIfB;
    }
}

