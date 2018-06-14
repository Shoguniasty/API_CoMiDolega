<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * DiseaseSymptoms
 *
 * @ORM\Table(name="disease_symptoms")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiseaseSymptomsRepository")
 */
class DiseaseSymptoms
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
     * @ManyToOne(targetEntity="Diseases")
     * @JoinColumn(name="diseases", referencedColumnName="id")
     */
    private $diseases;

    /**
     * @OneToOne(targetEntity="Symptoms")
     * @JoinColumn(name="symptoms", referencedColumnName="id")
     */
    private $symptoms;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

