<?php
namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category extends AbstractBase
{
    use TitleTrait;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Event", mappedBy="category", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $events;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param ArrayCollection $events
     *
     * @return $this
     */
    public function setEvents($events)
    {
        $this->events = $events;
        return $this;
    }

    /* @param Event $event
     *
     * @return $this
     */
    public function addEvent(Event $event)
    {
        $event->setCategory($this);
        $this->events->add($event);

        return $this;
    }

    /* @param Event $event
     *
     * @return $this
     */
    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);

        return $this;
    }

    public function __toString() {

        return $this->getTitle() ? $this->getTitle() : '---';
    }
}
