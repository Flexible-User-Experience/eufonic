<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;

/**
 * Date trait
 *
 * @category Trait
 * @package  AppBundle\Entity\Traits
 * @author   David Romaní <david@flux.cat>
 */
Trait DateTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @JMS\Groups({"list", "detail"})
     */
    private $date;

    /**
     * Set Date
     *
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get Date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get Date
     *
     * @return string
     */
    public function getDateString()
    {
        return $this->getDate()->format('d/m/Y');
    }
}
