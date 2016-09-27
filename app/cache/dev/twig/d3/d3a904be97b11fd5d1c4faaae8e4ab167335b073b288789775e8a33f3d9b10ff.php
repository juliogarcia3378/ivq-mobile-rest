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
        $__internal_42095d8fc22c3ffdd3a017781d0fd587c0baac724de63a1417377a0850974eb2 = $this->env->getExtension("native_profiler");
        $__internal_42095d8fc22c3ffdd3a017781d0fd587c0baac724de63a1417377a0850974eb2->enter($__internal_42095d8fc22c3ffdd3a017781d0fd587c0baac724de63a1417377a0850974eb2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_42095d8fc22c3ffdd3a017781d0fd587c0baac724de63a1417377a0850974eb2->leave($__internal_42095d8fc22c3ffdd3a017781d0fd587c0baac724de63a1417377a0850974eb2_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_28075f282b68876c998bde288feb2e38da6bf4b7039375010f43a207dbaa03ad = $this->env->getExtension("native_profiler");
        $__internal_28075f282b68876c998bde288feb2e38da6bf4b7039375010f43a207dbaa03ad->enter($__internal_28075f282b68876c998bde288feb2e38da6bf4b7039375010f43a207dbaa03ad_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_28075f282b68876c998bde288feb2e38da6bf4b7039375010f43a207dbaa03ad->leave($__internal_28075f282b68876c998bde288feb2e38da6bf4b7039375010f43a207dbaa03ad_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_29baccc794a3eed504785f60e772be662e44f81b395253ceb799c8629423dbde = $this->env->getExtension("native_profiler");
        $__internal_29baccc794a3eed504785f60e772be662e44f81b395253ceb799c8629423dbde->enter($__internal_29baccc794a3eed504785f60e772be662e44f81b395253ceb799c8629423dbde_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_29baccc794a3eed504785f60e772be662e44f81b395253ceb799c8629423dbde->leave($__internal_29baccc794a3eed504785f60e772be662e44f81b395253ceb799c8629423dbde_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_1d15c47d59384b59544af781d5f189e9a4b4355aa0420630eca96e2eb0048ab3 = $this->env->getExtension("native_profiler");
        $__internal_1d15c47d59384b59544af781d5f189e9a4b4355aa0420630eca96e2eb0048ab3->enter($__internal_1d15c47d59384b59544af781d5f189e9a4b4355aa0420630eca96e2eb0048ab3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_1d15c47d59384b59544af781d5f189e9a4b4355aa0420630eca96e2eb0048ab3->leave($__internal_1d15c47d59384b59544af781d5f189e9a4b4355aa0420630eca96e2eb0048ab3_prof);

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
