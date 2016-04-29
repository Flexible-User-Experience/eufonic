<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
//use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Exception\InvalidParameterException;

/**
 * Class EventController
 *
 * @category Controller
 * @package  AppBundle\Controller\API
 * @author   David Romaní <david@flux.cat>
 *
 * @Rest\NamePrefix("api_event_")
 * @Rest\Prefix("event")
 */
class EventController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Get events list
     *
     * @Rest\View(serializerGroups={"list"})
     * @Rest\Get("/list")
     * ApiDoc(
     *  section="Event",
     *  resource=true,
     *  description="Get events list",
     *  requirements={
     *      {"name"="_locale", "dataType"="string", "requirement"="ca|oc|es|en|fr", "description"="available locales"},
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
        $entities = $this->getDoctrine()->getRepository('AppBundle:Event')->findAll();

        return array('events' => $entities);
    }

    /**
     * Get event detail
     *
     * @Rest\View(serializerGroups={"detail"})
     * @Rest\Get("/{id}")
     * ApiDoc(
     *  section="Event",
     *  resource=true,
     *  description="Get event detail",
     *  requirements={
     *      {"name"="_locale", "dataType"="string", "requirement"="ca|oc|es|en|fr", "description"="available locales"},
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
        $entity = $this->getDoctrine()->getRepository('AppBundle:Event')->find($id);

        return array('event' => $entity);
    }
}
