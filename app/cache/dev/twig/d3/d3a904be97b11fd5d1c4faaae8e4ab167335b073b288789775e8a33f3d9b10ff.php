<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_9cc1b770badc7ee5506df08e6663673720d5dbc3f3754b4a0da37a3ad6003cc4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7a1ab17dbcec70f38ececae6e259677da9e8a07c91d83dd92eafe6c21e2218cd = $this->env->getExtension("native_profiler");
        $__internal_7a1ab17dbcec70f38ececae6e259677da9e8a07c91d83dd92eafe6c21e2218cd->enter($__internal_7a1ab17dbcec70f38ececae6e259677da9e8a07c91d83dd92eafe6c21e2218cd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7a1ab17dbcec70f38ececae6e259677da9e8a07c91d83dd92eafe6c21e2218cd->leave($__internal_7a1ab17dbcec70f38ececae6e259677da9e8a07c91d83dd92eafe6c21e2218cd_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_610c78dd9abe6d161ea2ff2ba247046a7bee3fbd440089cb5cae8ea57fbbe37a = $this->env->getExtension("native_profiler");
        $__internal_610c78dd9abe6d161ea2ff2ba247046a7bee3fbd440089cb5cae8ea57fbbe37a->enter($__internal_610c78dd9abe6d161ea2ff2ba247046a7bee3fbd440089cb5cae8ea57fbbe37a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_610c78dd9abe6d161ea2ff2ba247046a7bee3fbd440089cb5cae8ea57fbbe37a->leave($__internal_610c78dd9abe6d161ea2ff2ba247046a7bee3fbd440089cb5cae8ea57fbbe37a_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_d3da2b6ff16e4df7b9966e512eb8421bad9fa08bc7a2dafb92e4034e415b0348 = $this->env->getExtension("native_profiler");
        $__internal_d3da2b6ff16e4df7b9966e512eb8421bad9fa08bc7a2dafb92e4034e415b0348->enter($__internal_d3da2b6ff16e4df7b9966e512eb8421bad9fa08bc7a2dafb92e4034e415b0348_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_d3da2b6ff16e4df7b9966e512eb8421bad9fa08bc7a2dafb92e4034e415b0348->leave($__internal_d3da2b6ff16e4df7b9966e512eb8421bad9fa08bc7a2dafb92e4034e415b0348_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_03e37fcbb591ed360e6beadf1a32183b47d7d5227b611fdc0833d540f5ab070a = $this->env->getExtension("native_profiler");
        $__internal_03e37fcbb591ed360e6beadf1a32183b47d7d5227b611fdc0833d540f5ab070a->enter($__internal_03e37fcbb591ed360e6beadf1a32183b47d7d5227b611fdc0833d540f5ab070a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_03e37fcbb591ed360e6beadf1a32183b47d7d5227b611fdc0833d540f5ab070a->leave($__internal_03e37fcbb591ed360e6beadf1a32183b47d7d5227b611fdc0833d540f5ab070a_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
";
    }
}
