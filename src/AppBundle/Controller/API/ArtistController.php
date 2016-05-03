<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ArtistController
 *
 * @category Controller
 * @package  AppBundle\Controller\API
 * @author   David Romaní <david@flux.cat>
 *
 * @Rest\NamePrefix("api_artist_")
 * @Rest\Prefix("artist")
 */
class ArtistController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Get artists list
     *
     * @Rest\View(serializerGroups={"list"})
     * @Rest\Get("/list")
     * @ApiDoc(
     *  section="Artist",
     *  resource=true,
     *  description="Get artists list",
     *  requirements={
     *      {"name"="_format", "dataType"="string", "requirement"="json|xml", "description"="available formats"}
     *  },
     *  statusCodes={
     *         200="Returned when successful"
     *     }
     * )
     *
     * @return Response
     */
    public function cgetAction()
    {
        $entities = $this->getDoctrine()->getRepository('AppBundle:Artist')->findAll();

        return array('artists' => $entities);
    }

    /**
     * Get artists detail
     *
     * @Rest\View(serializerGroups={"detail"})
     * @Rest\Get("/{id}")
     * @ApiDoc(
     *  section="Artist",
     *  resource=true,
     *  description="Get artist detail",
     *  requirements={
     *      {"name"="id", "dataType"="integer", "description"="entity id"},
     *      {"name"="_format", "dataType"="string", "requirement"="json|xml", "description"="available formats"}
     *  },
     *  statusCodes={
     *         200="Returned when successful"
     *     }
     * )
     *
     * @return Response
     */
    public function getAction($id)
    {
        $entity = $this->getDoctrine()->getRepository('AppBundle:Artist')->find($id);

        return array('artist' => $entity);
    }
}
