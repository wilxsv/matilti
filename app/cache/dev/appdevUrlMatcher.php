<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = urldecode($pathinfo);

        // _wdt
        if (preg_match('#^/_wdt/(?P<token>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]+?)\\.txt$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?P<token>[^/]+?)/search/results$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?P<token>[^/]+?)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]+?)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

        // _welcome
        if ($pathinfo === '/home') {
            return array (  '_controller' => 'matilti\\usuarioBundle\\Controller\\DefaultController::publicoAction',  '_route' => '_welcome',);
        }

        // home
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'home');
            }
            return array (  '_controller' => 'matilti\\usuarioBundle\\Controller\\DefaultController::publicoAction',  '_route' => 'home',);
        }

        // modeloBundle_homepage
        if ($pathinfo === '/admin') {
            return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\DefaultController::indexAction',  '_route' => 'modeloBundle_homepage',);
        }

        if (0 === strpos($pathinfo, '/admin/estado')) {
            // admin_estado
            if (rtrim($pathinfo, '/') === '/admin/estado') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_estado');
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::indexAction',  '_route' => 'admin_estado',);
            }

            // admin_estado_show
            if ($pathinfo === '/admin/estado/show') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::showAction',  '_route' => 'admin_estado_show',);
            }

            // admin_estado_new
            if ($pathinfo === '/admin/estado/new') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::newAction',  '_route' => 'admin_estado_new',);
            }

            // admin_estado_create
            if ($pathinfo === '/admin/estado/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_estado_create;
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::createAction',  '_route' => 'admin_estado_create',);
            }
            not_admin_estado_create:

            // admin_estado_edit
            if (preg_match('#^/admin/estado/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::editAction',)), array('_route' => 'admin_estado_edit'));
            }

            // admin_estado_update
            if (preg_match('#^/admin/estado/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_estado_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::updateAction',)), array('_route' => 'admin_estado_update'));
            }
            not_admin_estado_update:

            // admin_estado_delete
            if (preg_match('#^/admin/estado/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_estado_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::deleteAction',)), array('_route' => 'admin_estado_delete'));
            }
            not_admin_estado_delete:

        }

        if (0 === strpos($pathinfo, '/admin/rol')) {
            // admin_rol
            if (rtrim($pathinfo, '/') === '/admin/rol') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_rol');
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::indexAction',  '_route' => 'admin_rol',);
            }

            // admin_rol_show
            if ($pathinfo === '/admin/rol/show') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::showAction',  '_route' => 'admin_rol_show',);
            }

            // admin_rol_new
            if ($pathinfo === '/admin/rol/new') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::newAction',  '_route' => 'admin_rol_new',);
            }

            // admin_rol_create
            if ($pathinfo === '/admin/rol/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_rol_create;
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::createAction',  '_route' => 'admin_rol_create',);
            }
            not_admin_rol_create:

            // admin_rol_edit
            if (preg_match('#^/admin/rol/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::editAction',)), array('_route' => 'admin_rol_edit'));
            }

            // admin_rol_update
            if (preg_match('#^/admin/rol/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_rol_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::updateAction',)), array('_route' => 'admin_rol_update'));
            }
            not_admin_rol_update:

            // admin_rol_delete
            if (preg_match('#^/admin/rol/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_rol_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::deleteAction',)), array('_route' => 'admin_rol_delete'));
            }
            not_admin_rol_delete:

        }

        if (0 === strpos($pathinfo, '/admin/regla')) {
            // admin_regla
            if (rtrim($pathinfo, '/') === '/admin/regla') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_regla');
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::indexAction',  '_route' => 'admin_regla',);
            }

            // admin_regla_show
            if ($pathinfo === '/admin/regla/show') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::showAction',  '_route' => 'admin_regla_show',);
            }

            // admin_regla_new
            if ($pathinfo === '/admin/regla/new') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::newAction',  '_route' => 'admin_regla_new',);
            }

            // admin_regla_create
            if ($pathinfo === '/admin/regla/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_regla_create;
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::createAction',  '_route' => 'admin_regla_create',);
            }
            not_admin_regla_create:

            // admin_regla_edit
            if (preg_match('#^/admin/regla/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::editAction',)), array('_route' => 'admin_regla_edit'));
            }

            // admin_regla_update
            if (preg_match('#^/admin/regla/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_regla_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::updateAction',)), array('_route' => 'admin_regla_update'));
            }
            not_admin_regla_update:

            // admin_regla_delete
            if (preg_match('#^/admin/regla/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_regla_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::deleteAction',)), array('_route' => 'admin_regla_delete'));
            }
            not_admin_regla_delete:

        }

        if (0 === strpos($pathinfo, '/admin/usuario')) {
            // admin_usuario
            if (rtrim($pathinfo, '/') === '/admin/usuario') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_usuario');
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::indexAction',  '_route' => 'admin_usuario',);
            }

            // admin_usuario_show
            if ($pathinfo === '/admin/usuario/show') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::showAction',  '_route' => 'admin_usuario_show',);
            }

            // admin_usuario_new
            if ($pathinfo === '/admin/usuario/new') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::newAction',  '_route' => 'admin_usuario_new',);
            }

            // admin_usuario_create
            if ($pathinfo === '/admin/usuario/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_usuario_create;
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::createAction',  '_route' => 'admin_usuario_create',);
            }
            not_admin_usuario_create:

            // admin_usuario_edit
            if (preg_match('#^/admin/usuario/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::editAction',)), array('_route' => 'admin_usuario_edit'));
            }

            // admin_usuario_update
            if (preg_match('#^/admin/usuario/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_usuario_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::updateAction',)), array('_route' => 'admin_usuario_update'));
            }
            not_admin_usuario_update:

            // admin_usuario_delete
            if (preg_match('#^/admin/usuario/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_usuario_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::deleteAction',)), array('_route' => 'admin_usuario_delete'));
            }
            not_admin_usuario_delete:

        }

        if (0 === strpos($pathinfo, '/admin/entidad')) {
            // admin_entidad
            if (rtrim($pathinfo, '/') === '/admin/entidad') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_entidad');
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::indexAction',  '_route' => 'admin_entidad',);
            }

            // admin_entidad_show
            if ($pathinfo === '/admin/entidad/show') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::showAction',  '_route' => 'admin_entidad_show',);
            }

            // admin_entidad_new
            if ($pathinfo === '/admin/entidad/new') {
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::newAction',  '_route' => 'admin_entidad_new',);
            }

            // admin_entidad_create
            if ($pathinfo === '/admin/entidad/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_entidad_create;
                }
                return array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::createAction',  '_route' => 'admin_entidad_create',);
            }
            not_admin_entidad_create:

            // admin_entidad_edit
            if (preg_match('#^/admin/entidad/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::editAction',)), array('_route' => 'admin_entidad_edit'));
            }

            // admin_entidad_update
            if (preg_match('#^/admin/entidad/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_entidad_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::updateAction',)), array('_route' => 'admin_entidad_update'));
            }
            not_admin_entidad_update:

            // admin_entidad_delete
            if (preg_match('#^/admin/entidad/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_entidad_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::deleteAction',)), array('_route' => 'admin_entidad_delete'));
            }
            not_admin_entidad_delete:

        }

        // usuarioBundle_homepage
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'matilti\\usuarioBundle\\Controller\\DefaultController::loginAction',  '_route' => 'usuarioBundle_homepage',);
        }

        // _security_check
        if ($pathinfo === '/login_check') {
            return array('_route' => '_security_check');
        }

        // _security_logout
        if ($pathinfo === '/logout') {
            return array('_route' => '_security_logout');
        }

        // reporteria
        if ($pathinfo === '/reporteria') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::indexAction',  '_route' => 'reporteria',);
        }

        // reporteria_defensoras
        if ($pathinfo === '/defensoras/cihuatlan') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::defensoraAction',  '_route' => 'reporteria_defensoras',);
        }

        // reporteria_cihuatlan
        if ($pathinfo === '/defensoras/reporte') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::defensoraAction',  '_route' => 'reporteria_cihuatlan',);
        }

        // reporteria_reportes
        if ($pathinfo === '/reportes') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::reportesAction',  '_route' => 'reporteria_reportes',);
        }

        // reporteria_general_ods
        if ($pathinfo === '/reporteria/generalods') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generalOdsAction',  '_route' => 'reporteria_general_ods',);
        }

        // reporteria_general_xls
        if ($pathinfo === '/reporteria/generalxls') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generalXlsAction',  '_route' => 'reporteria_general_xls',);
        }

        // reporteria_general_xml
        if ($pathinfo === '/reporteria/generalxml') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generalXmlAction',  '_route' => 'reporteria_general_xml',);
        }

        // reporteria_historial_ods
        if ($pathinfo === '/reporteria/historialods') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::historialOdsAction',  '_route' => 'reporteria_historial_ods',);
        }

        // reporteria_historial_xls
        if ($pathinfo === '/reporteria/historialxls') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::historialXlsAction',  '_route' => 'reporteria_historial_xls',);
        }

        // reporteria_historial_xml
        if ($pathinfo === '/reporteria/historialxml') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::historialXmlAction',  '_route' => 'reporteria_historial_xml',);
        }

        // reporteria_denuncias_ods
        if ($pathinfo === '/reporteria/denunciasods') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::denunciasOdsAction',  '_route' => 'reporteria_denuncias_ods',);
        }

        // reporteria_denuncias_xls
        if ($pathinfo === '/reporteria/denunciasxls') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::denunciasXlsAction',  '_route' => 'reporteria_denuncias_xls',);
        }

        // reporteria_denuncias_xml
        if ($pathinfo === '/reporteria/denunciasxml') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::denunciasXmlAction',  '_route' => 'reporteria_denuncias_xml',);
        }

        // reporteria_localidades_ods
        if ($pathinfo === '/reporteria/localidadesods') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::localidadesOdsAction',  '_route' => 'reporteria_localidades_ods',);
        }

        // reporteria_localidades_xls
        if ($pathinfo === '/reporteria/localidadesxls') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::localidadesXlsAction',  '_route' => 'reporteria_localidades_xls',);
        }

        // reporteria_localidades_xml
        if ($pathinfo === '/reporteria/localidadesxml') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::localidadesXmlAction',  '_route' => 'reporteria_localidades_xml',);
        }

        // reporteria_genero_ods
        if ($pathinfo === '/reporteria/generoods') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generoOdsAction',  '_route' => 'reporteria_genero_ods',);
        }

        // reporteria_genero_xls
        if ($pathinfo === '/reporteria/generoxls') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generoXlsAction',  '_route' => 'reporteria_genero_xls',);
        }

        // reporteria_genero_xml
        if ($pathinfo === '/reporteria/generoxml') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generoXmlAction',  '_route' => 'reporteria_genero_xml',);
        }

        // reporteria_edades_ods
        if ($pathinfo === '/reporteria/edadesods') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::edadesOdsAction',  '_route' => 'reporteria_edades_ods',);
        }

        // reporteria_edades_xls
        if ($pathinfo === '/reporteria/edadesxls') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::edadesXlsAction',  '_route' => 'reporteria_edades_xls',);
        }

        // reporteria_edades_xml
        if ($pathinfo === '/reporteria/edadesxml') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::edadesXmlAction',  '_route' => 'reporteria_edades_xml',);
        }

        // reporteria_encuestas_ods
        if ($pathinfo === '/reporteria/encuestasods') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::encuestasOdsAction',  '_route' => 'reporteria_encuestas_ods',);
        }

        // reporteria_encuestas_xls
        if ($pathinfo === '/reporteria/encuestasxls') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::encuestasXlsAction',  '_route' => 'reporteria_encuestas_xls',);
        }

        // reporteria_encuestas_xml
        if ($pathinfo === '/reporteria/encuestasxml') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::encuestasXmlAction',  '_route' => 'reporteria_encuestas_xml',);
        }

        // reporteria_localidades_mapa
        if ($pathinfo === '/reporteria/localidadesmapa') {
            return array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::localidadesMapaAction',  '_route' => 'reporteria_localidades_mapa',);
        }

        // mensajeria
        if ($pathinfo === '/mensajeria') {
            return array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::indexAction',  '_route' => 'mensajeria',);
        }

        // mensajeria_enviados
        if ($pathinfo === '/mensajeria/enviados') {
            return array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::listarEnviadosAction',  '_route' => 'mensajeria_enviados',);
        }

        // mensajeria_recibidos
        if ($pathinfo === '/mensajeria/recibidos') {
            return array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::listarRecibidosAction',  '_route' => 'mensajeria_recibidos',);
        }

        // mensajeria_encuestas
        if ($pathinfo === '/mensajeria/encuestas') {
            return array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::listarEncuestasAction',  '_route' => 'mensajeria_encuestas',);
        }

        // mensajeria_enviar
        if ($pathinfo === '/mensajeria/enviar') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_mensajeria_enviar;
            }
            return array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::enviarMensajeAction',  '_route' => 'mensajeria_enviar',);
        }
        not_mensajeria_enviar:

        // mensajeria_contestar
        if (0 === strpos($pathinfo, '/mensajeria/contestar') && preg_match('#^/mensajeria/contestar/(?P<id>[^/]+?)$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_mensajeria_contestar;
            }
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::contestarMensajeAction',)), array('_route' => 'mensajeria_contestar'));
        }
        not_mensajeria_contestar:

        // mensajeria_publicar
        if (0 === strpos($pathinfo, '/mensajeria/publicar') && preg_match('#^/mensajeria/publicar/(?P<id>[^/]+?)$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_mensajeria_publicar;
            }
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::publicarMensajeAction',)), array('_route' => 'mensajeria_publicar'));
        }
        not_mensajeria_publicar:

        // mensajeria_encuestar
        if ($pathinfo === '/mensajeria/encuestar') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_mensajeria_encuestar;
            }
            return array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::enviarEncuestaAction',  '_route' => 'mensajeria_encuestar',);
        }
        not_mensajeria_encuestar:

        // mensajeria_consultar
        if ($pathinfo === '/mensajeria/consultar') {
            return array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::listarConsultasAction',  '_route' => 'mensajeria_consultar',);
        }

        // mensajeria_encuestar_consulta
        if ($pathinfo === '/mensajeria/consultarEncuesta') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_mensajeria_encuestar_consulta;
            }
            return array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::consultarEncuestaAction',  '_route' => 'mensajeria_encuestar_consulta',);
        }
        not_mensajeria_encuestar_consulta:

        if (0 === strpos($pathinfo, '/ws')) {
            // _webservice_call
            if (preg_match('#^/ws/(?P<webservice>[^/]+?)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not__webservice_call;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BeSimple\\SoapBundle\\Controller\\SoapWebServiceController::CallAction',  '_format' => 'xml',)), array('_route' => '_webservice_call'));
            }
            not__webservice_call:

            // _webservice_definition
            if (preg_match('#^/ws/(?P<webservice>[^/]+?)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not__webservice_definition;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BeSimple\\SoapBundle\\Controller\\SoapWebServiceController::DefinitionAction',  '_format' => 'xml',)), array('_route' => '_webservice_definition'));
            }
            not__webservice_definition:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
