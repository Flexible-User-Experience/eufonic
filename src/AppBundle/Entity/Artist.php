<?php
namespace AppBundle\Entity;

use AppBundle\Entity\Traits\DescriptionTrait;
use AppBundle\Entity\Traits\ImageTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Artist
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtistRepository")
 * @Vich\Uploadable
 */
class Artist extends AbstractBase
{
    use DescriptionTrait;
    use ImageTrait;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="artist", fileNameProperty="imageName")
     * @Assert\File(
     *     maxSize = "10M",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"}
     * )
     * @Assert\Image(minWidth = 1200)
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(checkDNS=true)
     */
    private $urlVimeo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(checkDNS=true)
     */
    private $urlSoundCloud;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Event", mappedBy="artist")
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
     * Artist constructor.
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Artist
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlVimeo()
    {
        return $this->urlVimeo;
    }

    /**
     * @param string $urlVimeo
     *
     * @return Artist
     */
    public function setUrlVimeo($urlVimeo)
    {
        $this->urlVimeo = $urlVimeo;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlSoundCloud()
    {
        return $this->urlSoundCloud;
    }

    /**
     * @param string $urlSoundCloud
     *
     * @return Artist
     */
    public function setUrlSoundCloud($urlSoundCloud)
    {
        $this->urlSoundCloud = $urlSoundCloud;
        return $this;
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
        $event->setArtist($this);
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

        return $this->getName() ? $this->getName() : '---';
    }
}
