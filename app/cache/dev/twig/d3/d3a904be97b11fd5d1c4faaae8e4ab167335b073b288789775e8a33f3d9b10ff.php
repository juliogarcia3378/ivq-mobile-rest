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
        $__internal_1223d375d07e0f20f3ae6994d3e7dc2296659698b7f025d8be59707f9e4dc7fe = $this->env->getExtension("native_profiler");
        $__internal_1223d375d07e0f20f3ae6994d3e7dc2296659698b7f025d8be59707f9e4dc7fe->enter($__internal_1223d375d07e0f20f3ae6994d3e7dc2296659698b7f025d8be59707f9e4dc7fe_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1223d375d07e0f20f3ae6994d3e7dc2296659698b7f025d8be59707f9e4dc7fe->leave($__internal_1223d375d07e0f20f3ae6994d3e7dc2296659698b7f025d8be59707f9e4dc7fe_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_4bbdf4bca01b87d9be0e07d905d11415d80b1c6b84ede529197104439b538706 = $this->env->getExtension("native_profiler");
        $__internal_4bbdf4bca01b87d9be0e07d905d11415d80b1c6b84ede529197104439b538706->enter($__internal_4bbdf4bca01b87d9be0e07d905d11415d80b1c6b84ede529197104439b538706_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_4bbdf4bca01b87d9be0e07d905d11415d80b1c6b84ede529197104439b538706->leave($__internal_4bbdf4bca01b87d9be0e07d905d11415d80b1c6b84ede529197104439b538706_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_f001273200b013424948f3ac1215cd6e99704171391581991dfc4a78366559c7 = $this->env->getExtension("native_profiler");
        $__internal_f001273200b013424948f3ac1215cd6e99704171391581991dfc4a78366559c7->enter($__internal_f001273200b013424948f3ac1215cd6e99704171391581991dfc4a78366559c7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_f001273200b013424948f3ac1215cd6e99704171391581991dfc4a78366559c7->leave($__internal_f001273200b013424948f3ac1215cd6e99704171391581991dfc4a78366559c7_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_cbf9a15c72b7cad75e08a76beec5107e179594d2dc1f1f86df9d12be4fe28359 = $this->env->getExtension("native_profiler");
        $__internal_cbf9a15c72b7cad75e08a76beec5107e179594d2dc1f1f86df9d12be4fe28359->enter($__internal_cbf9a15c72b7cad75e08a76beec5107e179594d2dc1f1f86df9d12be4fe28359_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_cbf9a15c72b7cad75e08a76beec5107e179594d2dc1f1f86df9d12be4fe28359->leave($__internal_cbf9a15c72b7cad75e08a76beec5107e179594d2dc1f1f86df9d12be4fe28359_prof);

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
