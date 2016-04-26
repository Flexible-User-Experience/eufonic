<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class ArtistAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class ArtistAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Artist';
    protected $baseRoutePattern = 'artists/artist';
    protected $datagridValues = array(
        '_sort_by'    => 'name',
        '_sort_order' => 'asc',
    );

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('batch');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.general', $this->getFormMdSuccessBoxArray(8))
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.coworker.name',
                )
            )
            ->add(
                'description',
                'ckeditor',
                array(
                    'label' => 'backend.admin.coworker.description',
                    'config_name' => 'my_config',
                    'required'    => true,
                )
            )
            ->add(
                'imageFile',
                'file',
                array(
                    'label'    => 'backend.admin.post.image',
                    'help'     => $this->getImageHelperFormMapperWithThumbnail(),
                    'required' => false,
                )
            )
            ->add(
                'urlVimeo',
                null,
                array(
                    'label' => 'backend.admin.coworker.name',
                )
            )
            ->add(
                'urlSoundCloud',
                null,
                array(
                    'label' => 'backend.admin.coworker.name',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(4))
            ->add(
                'enabled',
                'checkbox',
                array(
                    'label'    => 'backend.admin.enabled',
                    'required' => false,
                )
            )
            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.coworker.name',
                )
            )
            ->add(
                'description',
                null,
                array(
                    'label' => 'backend.admin.coworker.email',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'backend.admin.enabled',
                    'editable' => true,
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add(
                'image',
                null,
                array(
                    'label'    => 'backend.admin.event.image',
                    'template' => '::Admin/Cells/list__cell_image_field.html.twig'
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.coworker.name',
                    'editable' => true,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'backend.admin.enabled',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'label'   => 'backend.admin.actions',
                    'actions' => array(
                        'edit'   => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    )
                )
            );
    }
}
